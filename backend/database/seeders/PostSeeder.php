<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Helpers\Factories\FactoryHelper;
use App\Traits\Database\Seeders\ForeignKeyChecks;
use App\Traits\Database\Seeders\TruncateTable;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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
        $this->truncate('posts');
        $posts = Post::factory(3)->create();
        $posts->each(function (Post $post) {
            $post->users()->attach([FactoryHelper::getRandomModelId(User::class)]);
        });
        $this->enableForeignKeyChecks();
    }
}
