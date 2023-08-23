<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserController1 extends TestCase
{
    use RefreshDatabase , WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testUserProfileIsShownCorrectly() {
        $user = $this->createUser(true);
        $this->json('get', "api/profile/".$user->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(
                [
                    'data' => $this->returnUserFakeProfileResource()
                ]
            );
    }


    // public function testUpdateUserReturnsCorrectData() {
    //     $user = $this->createUser();
    //     $payload = $this->returnFakeUser($password=false);
    //     $this->json('put', "api/users/$user->id", $payload)
    //         ->assertStatus(Response::HTTP_OK)
    //         ->assertExactJson(
    //             [
    //                 'data' => [
    //                     'id' => $user->id,
    //                     'name' => $payload['name'],
    //                     'email' => $payload['email'],

    //                 ]
    //             ]
    //         );
    // }


    // public function testUserIsDestroyed() {
    //    $user = $this->createUser();
    //     $this->json('delete', "api/users/".$user->id)
    //     ->assertStatus(Response::HTTP_OK);
    //     $this->assertDatabaseMissing('users', $user->toArray());
    // }

    private function returnUserFakeProfileResource()
    {
        return [
            'id',
            'name',
            'username',
            'image',
            'isFreelancer',
            'created_at',
            'address',
            'phone',
            'email',
            'description',
            'total_reviews',
            'user_rating',
            'recent_delivery',
            'user_languages',
            'user_skills',
            'services',
        ];
    }
}
