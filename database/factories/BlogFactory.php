<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Blog::class;
    public function definition(): array
    {
        return [
            'title' => fake()->text(),
            'intro' => fake()->text(),
            'slug' => fake()->unique()->slug(5),
            'body'=>fake()->paragraph(3, true),
            'category_id'=>Category::factory(),
        ];
    }
}
