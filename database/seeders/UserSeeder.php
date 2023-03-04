<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\PostFactory;
use Database\Factories\CommentFactory;
use Database\Factories\UserFactory;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 stand-alone users
        User::factory()
        ->count(10)
        ->create();
    }
}
