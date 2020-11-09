<?php

namespace Database\Seeders;

use App\User;
use App\Entry;
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
        User::factory()->create([
            'name' => 'Charles Harries',
            'email' => 'charles@harries.me',
        ]);
    }
}
