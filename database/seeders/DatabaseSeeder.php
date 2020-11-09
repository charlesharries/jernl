<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Charles Harries',
            'email' => 'charles@harries.me',
            'password' => '$2y$12$1RrBM9oiAaQKpE.He3YcfunqELJGfvACBQZLBgTWrJWJ0OvRYh45a' // secret
        ]);
    }
}
