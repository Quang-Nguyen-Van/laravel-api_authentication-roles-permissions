<?php

namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class CommentRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use($attributes) {
            $created = Comment::query()->create([
                'body' => data_get($attributes, 'body'),
                'user_id' => data_get($attributes, 'user_id'),
                'post_id' => data_get($attributes, 'post_id'),
            ]);
            throw_if(!$created, GeneralJsonException::class, 'Failed to create comment');
            // event(new CommentCreated($created));
            return $created;
        });
    }

    public function update($comment, array $attributes)
    {
        return DB::transaction(function() use($comment, $attributes){
            $updated = $comment->update([
                'body' => data_get($attributes, 'body'),
                'user_id' => data_get($attributes, 'user_id'),
                'post_id' => data_get($attributes, 'post_id'),
            ]);
            throw_if(!$updated, GeneralJsonException::class, 'Failed to update comment');

            // event(new CommentUpdated($comment));
            return $comment;
        });
    }

    public function forceDelete($comment)
    {
        return DB::transaction(function () use($comment) {
            $deleted = $comment->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Failed to delete comment');
            // event(new CommentDeleted($comment));
            return $deleted;
        });
    }
}
