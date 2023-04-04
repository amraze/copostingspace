<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Traits\Database\Seeders\ForeignKeyChecks;
use App\Traits\Database\Seeders\TruncateTable;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    use TruncateTable, ForeignKeyChecks;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeyChecks();
        $this->truncate('comments');
        Comment::factory(3)->create();
        $this->enableForeignKeyChecks();
    }
}
