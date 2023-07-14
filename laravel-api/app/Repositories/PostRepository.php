<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Events\Models\Post\PostCreated;
use App\Exceptions\GeneralJsonException;

class PostRepository extends BaseRepository
{
    public function create(array $attributies)
    {
        return DB::transaction(function () use ($attributies) {
            $post = Post::query()->create([
                'title' => data_get($attributies, 'title', 'Untitled'),
                'body' => data_get($attributies, 'body'),
            ]);

            throw_if(!$post, GeneralJsonException::class, 'Failed to create post');

            // event(new PostCreated($post));
            // event(PostCreated::class);
            // PostCreated::dispatch();

            if($userIds = data_get($attributies, 'user_ids')){
                $post->users()->sync($userIds);
            }

            return $post;
        });
    }

    public function update($post, array $attributies)
    {
        return DB::transaction(function () use ($post, $attributies){
            $updated = $post->update([
                'title' => data_get($attributies, 'title', $post->title),
                'body' => data_get($attributies, 'body', $post->body),
            ]);

            if($userIds = data_get($attributies, 'user_ids')){
                $post->users->syn($userIds);
            }

            throw_if(!$updated, GeneralJsonException::class, 'Fail to update post');

            return $post;
        });
    }

    public function forceDelete($post)
    {
        return DB::transaction(function () use($post){
            $deleted = $post->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Can not delete post');

            return $deleted;
        });

    }
}
