<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use Database\Factories\CommentFactory;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $posts = Post::all();

         foreach ($posts as $post) {
            Comment::factory()
                ->count(2)
                ->for($post)
                ->create();
         }
    }
}
