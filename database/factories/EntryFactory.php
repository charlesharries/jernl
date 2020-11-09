<?php

namespace Database\Factories;

use App\Entry;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::first();

        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(10),
            'user_id' => $user->id,
            'date' => now(),
        ];
    }
}
