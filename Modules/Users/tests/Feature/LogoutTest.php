<?php

namespace Modules\Users\Tests\Feature;

use Laravel\Sanctum\Sanctum;
use Modules\Users\Models\Customer;
use Modules\Users\Models\User;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * Test the logout functionality.
     *
     * @return void
     */
    public function testLogout()
    {
        /**
         * @var User
         */
        $user = Customer::factory()->create();

        // Simulate a user login
        Sanctum::actingAs($user);

        // Perform the logout action
        $response = $this->post(route('api.logout'));

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the user is no longer authenticated
        $this->assertTrue($user->tokens()->count() === 0, 'User tokens should be deleted after logout');
    }
}
