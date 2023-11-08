<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraphs(3, true),
            'link' => $this->faker->url,
            'guid' => $this->faker->uuid,
            'pub_date' => $this->faker->dateTime,
            'feed_id' => \App\Models\Feed::factory(),
        ];
    }
}
