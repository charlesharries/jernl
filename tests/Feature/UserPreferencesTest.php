<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPreferencesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_user_preferences() {
        $user = User::factory()->create();

        $usesSerif = $user->use_serif;

        $this->assertFalse($usesSerif);
    }

    /** @test */
    public function it_allows_a_user_to_set_their_serif_preference() {
        $user = User::factory()->create();

        $this->actingAs($user)->patch('/user-preferences', ['use_serif' => true]);
        $user->refresh();

        $this->assertTrue($user->use_serif);
    }
}
