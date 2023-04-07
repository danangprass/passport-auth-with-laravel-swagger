<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidate>
 */
class CandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'experience' => $this->faker->numberBetween(0,5),
            'education' => $this->faker->sentence(2),
            'bod' => $this->faker->date(),
            'last_position' => $this->faker->jobTitle(),
            'applied_position' => $this->faker->jobTitle(),
            'skills' => $this->faker->sentence(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'resume_url' => $this->faker->url(),
        ];
    }
}
