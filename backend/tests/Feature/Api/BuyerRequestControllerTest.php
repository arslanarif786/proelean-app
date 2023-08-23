<?php

namespace Tests\Feature\Api;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BuyerRequestControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testAreJobListShowingCorrectlyToSeller()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $job = $this->createJob($fakeJob);

        $seller = $this->createUser(true, 1);
        $response = $this->actingAs($seller)->json('get', 'api/seller/buyer_requests')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->returnFakeJobResource()
                    ]
                ]
            );

        $response->assertJson(fn (AssertableJson $json)=>
            $json->has('meta')
                ->has('links')
                ->has('data.0',fn ($json) =>
                $json
                ->has('user')
                ->whereAllType($this->returnFakeJobResourceTypes()) )
        );
        $this->assertDatabaseHas('jobs', $fakeJob);
    }

    // SEND OFFER TO ANY JOB TEST
    public function testIsSellerAbleToSendOfferToJobSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);

        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $job = $this->createJob($fakeJob);

        $seller = $this->createUser(true,1);
        $service = $this->createService($category->id, $subCategory->id, $seller->id);

        $payload=[
            'service_id'=>$service->id,
            'job_id'=>$job->id,
            'description'=>$this->faker->text(20),
            'price'=>34.4,
            'delivery_time'=>'35 days'
        ];

        $response=$this->actingAs($seller)->json('post', 'api/seller/send_offer',$payload)
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'message' => [

                ]
            ]
        );
        $response->assertOk();
    }

    // CANCEL OFFER TO ANY JOB TEST
    public function testIsSellerAbleToCancelOfferToJobSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);

        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $job = $this->createJob($fakeJob);

        $seller = $this->createUser(true,1);
        $service = $this->createService($category->id, $subCategory->id, $seller->id);

        $response=$this->actingAs($seller)->json('delete', 'api/seller/cancel_offer/'.$job->id,[])
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'message' => [

                ]
            ]
        );
        $response->assertOk();
    }
}
