<?php

namespace Modules\Users\Tests\Feature;

use Tests\TestCase;
use Modules\Users\Models\Customer;

class LoginTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // set your headers here
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    /**
     * Test the login endpoint with valid credentials.
     *
     * @test
     */
    public function login_validation()
    {
        $this->postJson(route('api.login'), [])
            ->assertSee('data')
            ->assertJsonStructure([
                'data',
                'success',
                'message'
            ]);

        $this->postJson(route('api.login'), [
            'username' => 'customer@demo.com',
            'password' => 'password',
        ])->assertSee('success')
            ->assertJsonStructure([
                'message',
                'success'
            ]);
    }

    /** @test */
    public function user_login()
    {
        $user = Customer::factory()->create();

        $response = $this->postJson(route('api.login'), [
            'username' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data',
                'message',
                'success'
            ]);

        $response = $this->postJson(route('api.login'), [
            'username' => $user->phone,
            'password' => 'password',
        ]);

        $response->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data',
                'message',
                'success'
            ]);
    }
}
