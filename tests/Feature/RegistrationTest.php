<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_a_registration_route()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function it_allows_users_to_register() {
        $response = $this->post('/register', [
            'name' => "Charles Harries",
            'email' => "charles+test@harries.me",
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect('/calendar');
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function it_prevents_a_user_from_registering_twice() {
        $user = User::factory()->create();

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertCount(1, User::all());
    }
}
