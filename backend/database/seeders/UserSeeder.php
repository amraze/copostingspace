<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Traits\ForeignKeyChecks;
use Database\Seeders\Traits\TruncateTable;
use App\Models\User;

class UserSeeder extends Seeder
{
    use ForeignKeyChecks, TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeyChecks();
        $this->truncate('users');
        User::factory(10)->create();
        $this->enableForeignKeyChecks();
    }
}
