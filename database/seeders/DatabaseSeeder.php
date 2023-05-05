<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use App\Models\Role;
use Database\Factories\PostFactory;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;
use Database\Factories\TagFactory;
use Database\Factories\ProfileFactory;
use Database\Factories\RoleFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
