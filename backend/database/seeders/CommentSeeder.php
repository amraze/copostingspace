<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\Traits\ForeignKeyChecks;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
