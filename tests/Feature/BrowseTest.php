<?php

namespace Tests\Feature;

use App\User;
use App\Entry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_authenticates_the_browse_page()
    {
        $response = $this->get('/browse');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_renders_the_browse_page()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withCookies(['password_key' => User::generatePasswordKey('password')])
            ->get('/browse');

        $response->assertViewIs('browse');
    }

    /** @test */
    public function it_renders_out_user_entries()
    {
        $user = User::factory()->create();
        $entry = Entry::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/browse');

        $response->assertSee($entry->title);
        $response->assertSee($entry->content);
    }
}
