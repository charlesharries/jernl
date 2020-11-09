<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrowseTest extends TestCase
{
    public function it_authenticates_the_browse_page()
    {
        $response = $this->get('/browse');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function it_renders_the_browse_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/browse');
    }
}
