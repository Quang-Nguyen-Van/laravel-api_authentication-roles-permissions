<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Events\Models\Users\UserCreated;
use App\Events\Models\Users\UserDeleted;
use App\Events\Models\Users\UserUpdated;

class UserRepository extends BaseRepository
{
    public function create(array $attributes)
    {
        return DB::transaction(function () use($attributes) {
            $user = User::create([
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),
                'password' =>  Hash::make(data_get($attributes, 'password')),
            ]);

            throw_if(!$user, GeneralJsonException::class, 'Failed to create model');

            event(new UserCreated($user));
            return $user;
        });

    }

    public function update($user, array $attributes)
    {
        return DB::transaction(function () use($user, $attributes){
            $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
            ]);

            throw_if(!$user, GeneralJsonException::class, 'Failed to update user');

            event(new UserUpdated($user));

            return $user;
        });
    }

    public function forceDelete($user)
    {
        return DB::transaction(function () use($user) {
            $deleted = $user->forceDelete();

            throw_if(!$deleted, GeneralJsonException::class, 'Can not delete user');
            event(new UserDeleted($user));
            return $deleted;
        });
    }
}
