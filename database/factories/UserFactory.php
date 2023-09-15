<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'role' => 'student',
            'image' => 'image\DDRVwyIqREaVt8Chpuc2lNhgnGrGca4vyWwBuJvx.jpg',
            'name' => fake()->name(),
            'mob' => fake()->numberBetween('6006006000','9999999999'),
            'dob' => fake()->date('Y-m-d'),
            'address' => fake()->address(),
            'gender' => 'm',
            'hobbies' => 'cricket',
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('aassaass'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
