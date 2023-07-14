<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeinKeys
{
    protected function disableForeinKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function enableForeinKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
