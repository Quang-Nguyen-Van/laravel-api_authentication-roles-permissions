<?php

namespace Database\Seeders;

use Database\Seeders\Traits\DisableForeinKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    use TruncateTable, DisableForeinKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->disableForeinKeys();

        $this->truncate('users');
        $users = \App\Models\User::factory(10)->create();

        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->enableForeinKeys();
    }
}
