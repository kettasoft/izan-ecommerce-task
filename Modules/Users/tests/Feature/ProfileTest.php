<?php

namespace Modules\Users\Tests\Feature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Modules\Users\Models\Customer;

class ProfileTest extends TestCase
{
    /** @test */
    public function only_to_authenticated_user_can_display_his_profile()
    {
        $user = Customer::factory()->create();

        $this->getJson(route('api.profile'))
            ->assertStatus(401);

        Sanctum::actingAs($user, ['*']);

        $this->getJson(route('api.profile'))
            ->assertSuccessful()
            ->assertSee('data')
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'email',
                    'phone',
                ]
            ]);
    }
}
