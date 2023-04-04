<?php

namespace App\Traits\Database\Seeders;

use Illuminate\Support\Facades\DB;

trait ForeignKeyChecks
{
    protected function disableForeignKeyChecks()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function enableForeignKeyChecks()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
