<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Rules\IntegerArray;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use App\Http\Requests\PostStoreRequest;
use App\Exceptions\GeneralJsonException;
use App\Http\Requests\UpdatePostRequest;
use App\Models\User;
use App\Notifications\PostSharedNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show', 'store']);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index(Request $request)
    {
        // throw new GeneralJsonException('Some Errorrrrrr', 422);

        $pageSize = $request->page_size ?? 20;
        $posts = Post::query()->paginate($pageSize);
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostStoreRequest  $request
     * @return PostResource
     */
    public function store(PostStoreRequest $request, PostRepository $repository)
    {
        $payload = $request->only([
            'title',
            'body',
            'user_ids'
        ]);

        $validator = Validator::make($payload, [
            'title' => 'string|required',
            'body' => ['string', 'required'],
            'user_ids' => [
                'array',
                'required',
                new IntegerArray(),
            ],
            [
                'body.required' => "Please enter a value for body.",
                'title.string' => "Heyyyy use a string",
            ],
            [
                'user_ids.required' => "Please enter value for user_ids",
            ]
            ]);

        $validator->validate();

        $created = $repository->create($payload);

        // $created = $repository->create($request->only([
        //     'title',
        //     'body',
        //     'user_ids'
        // ]));


        // $created = DB::transaction(function () use ($request) {
        //     $created = Post::query()->create([
        //         'title' => $request->title,
        //         'body' => $request->body,
        //     ]);

        //     if($userIds = $request->user_ids){
        //         $created->users()->sync($userIds);
        //     }

        //     return $created;
        // });

        return new PostResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return PostResource | JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post, PostRepository $repository)
    {
        $post = $repository->update($post, $request->only([
            'title',
            'body',
            'user_ids',
        ]));

        // $updated = $post->update([
        //     'title' => $request->title ?? $post->title,
        //     'body' => $request->body ?? $post->body
        // ]);

        // if(!$updated){
        //     return new JsonResponse([
        //         'errors' => ['Failed to update model.'],
        //     ], 400);
        // }

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post, PostRepository $repository)
    {
        $deleted = $repository->forceDelete($post);
        // $deleted = $post->forceDelete();

        if(!$deleted){
            return new JsonResponse([
                'errors' => ['Could not delete resource']
            ], 400);
        }

        return new JsonResponse([
            'data' => 'Delete Successfully'
        ]);
    }

    /**
     * Share a specified resource from storage.
     * @response 200 {
     * "data": "signed url..."
     * }
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function share(Request $request, Post $post)
    {
        $url = URL::temporarySignedRoute('shared.post', now()->addDays(30), [
            'post' => $post->id,
        ]);

        $users = User::query()->whereIn('id', $request->user_ids)->get();

        Notification::send($users, new PostSharedNotification($post, $url));

        return new JsonResponse([
            'data' => $url,
        ]);
    }
}
