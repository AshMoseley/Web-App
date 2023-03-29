<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\Forum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    protected $model = Forum::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->paragraph(3),

        ];
    }
    
    public function configure()
    {
        return $this->afterCreating(function (Forum $forum) {
            $posts = Post::factory()
                ->count(5)
                ->for($forum)
                ->create();
            $forum->posts()->saveMany($posts);
        });
    }
}
