<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'Charles Harries',
            'email' => 'charles@harries.me',
            'password' => '$2y$12$1RrBM9oiAaQKpE.He3YcfunqELJGfvACBQZLBgTWrJWJ0OvRYh45a' // secret
        ]);
    }
}
