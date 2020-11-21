<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$12$sJfiqmnhEPLkg6kUqoUT6.0iYGevdnr5GXKwMyE8aveqF/SzJQT4q', // password
            'remember_token' => Str::random(10),
            'encrypted_user_key' => User::generateEncryptedUserKey('password'),
        ];
    }
}
