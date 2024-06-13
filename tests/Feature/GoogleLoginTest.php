<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Mockery;
use Faker\Factory as Faker;

class GoogleLoginTest extends TestCase
{
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    public function testRedirectToProvider()
    {
        $response = $this->get('/login/google');
        
        $response->assertStatus(302); // Check if it redirects
        $response->assertRedirectContains('google'); // Check if redirect URL contains 'google'
    }

    public function testHandleProviderCallback()
    {
        $email = $this->faker->unique()->safeEmail;
        $name = $this->faker->name;
        $username = $this->faker->userName;

        $abstractUser = Mockery::mock(\Laravel\Socialite\Two\User::class);
        $abstractUser->shouldReceive('getId')->andReturn($username); // Use username here
        $abstractUser->shouldReceive('getEmail')->andReturn($email);
        $abstractUser->shouldReceive('getName')->andReturn($name);
        $abstractUser->shouldReceive('getNickname')->andReturn($username);

        $socialite = Mockery::mock(SocialiteFactory::class);
        $socialite->shouldReceive('driver->user')->andReturn($abstractUser);

        $this->app->instance(SocialiteFactory::class, $socialite);

        $response = $this->get('/login/google/callback');
        
        $response->assertStatus(302); // Check if it redirects
        $response->assertRedirect('/dashboard'); // Check if it redirects to dashboard

        $user = User::where('email', $email)->first();
        $this->assertNotNull($user); // Check if the user was created
        $this->assertAuthenticatedAs($user); // Check if the user is authenticated

    }
}
