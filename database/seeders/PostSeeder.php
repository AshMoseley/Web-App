<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Tag;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Creates a post that has 2 comments, as well as 3 tags
        Post::factory()
        ->count(10)
        ->has(Comment::factory()->count(2))
        ->create()
        ->each(function ($post) {
            $tags = Tag::factory()->count(3)->create();
            $post->tags()->sync($tags);
        });
    }
}
