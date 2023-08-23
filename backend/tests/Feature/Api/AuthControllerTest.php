<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserIsRegisteredSuccessfully()
    {
        $payload = $this->returnFakeUser();
        $payload['password_confirmation'] = '12345678';
        $this->json('post', 'api/register', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message' => []
                ]
            );
        unset($payload['password']);
        unset($payload['password_confirmation']);
        $this->assertDatabaseHas('users', $payload);
    }

    public function testUserIsLoggedInSuccessfully()
    {
        $user = $this->createUser(true);
        $this->assertDatabaseHas('users', $user->only('email', 'id'));
        $payload = ['email' => $user->email, 'password' => '12345678'];
        $this->post('api/login', $payload)
            ->assertStatus(Response::HTTP_FORBIDDEN);
        //  ->assertJsonStructure(
        //      [
        //          'data' => $this->returnFakeUserResource(),
        //          "token",
        //          "message"
        //      ]
        //  );
        $this->assertAuthenticated();
    }

    public function testUserIsLoggedOutSuccessfully()
    {
        $user = $this->createUser(true);
        // if (auth()->attempt(['email' => $user->email, 'password' => '12345678'])) {
        //     auth()->user()->createToken($user->email)->plainTextToken;
        // }

        $user = Sanctum::actingAs($user);
        $this->post('api/logout')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    "message" => []
                ]
            );
        $this->assertAuthenticated();
    }

    private function returnFakeUserResource()
    {
        return  [
            'id',
            'email',
            'name',
            'username',
            'image',
            'isFreelancer',
            'phone',
            'address',
            'city',
            "rating",
            "total_reviews",
            "availabe_balance",
            "pending_balance",
            "withdraw_balance",
            "expected_balance",
        ];
    }
}
