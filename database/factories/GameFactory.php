<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(3, true),
            'release_date' => $this->faker->date(),
            'publisher_id' => \App\Models\Publisher::factory(),
            'developer_id' => \App\Models\Developer::factory(),
        ];
    }
}
