<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeinKeys;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    use TruncateTable, DisableForeinKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeinKeys();
        $this->truncate('comments');

        Comment::factory(3)
            // ->for(Post::factory(1), 'post')
            ->create();

        $this->enableForeinKeys();
    }
}
