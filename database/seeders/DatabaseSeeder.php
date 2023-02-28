<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Database\Factories\PostFactory;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;
use Database\Factories\TagFactory;
use Database\Factories\ProfileFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Post::factory()
        // ->count(10)
        // ->has(Comment::factory()->count(2))
        // ->create();
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProfileSeeder::class);


    }
}
