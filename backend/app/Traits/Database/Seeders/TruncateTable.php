<?php

namespace App\Traits\Database\Seeders;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    protected function truncate($table)
    {
        DB::table($table)->truncate();
    }
}
