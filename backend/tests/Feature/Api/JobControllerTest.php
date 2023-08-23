<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class JobControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testJobIsCreatedSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $payload = $this->returnFakeJob($category->id, $subCategory->id, $user->id);

        $response=$this->actingAs($user)->json('post', 'api/buyer/jobs', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => $this->returnFakeJobResource()
                ]
            );

        $response->assertJson(fn (AssertableJson $json)=>
            $json->has('data',fn($json)=> $json->whereAllType($this->returnFakeJobResourceTypes()) )
        );
        $this->assertDatabaseHas('jobs', $payload);
    }

    public function testGetJobsSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $payload = $this->createJob($fakeJob);

        $response = $this->actingAs($user)->json('get', 'api/buyer/jobs')
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
                ->has('data')
                ->whereType("data","array",fn ($json) => $json->whereAllType($this->returnFakeJobResourceTypes()) )
        );
        $response->assertOk();
    }

    public function testJobsIsShownSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $job = $this->createJob($fakeJob);

        $response = $this->actingAs($user)->json('get', 'api/buyer/jobs/' . $job->id)
            ->assertJsonStructure(
                [
                    'data' => $this->returnFakeJobResource()
                ]
            );

        $response->assertJson(fn (AssertableJson $json)=>
            $json->has('data',fn ($json)=>
                    $json->whereAllType($this->returnFakeJobResourceTypes())
                )
            );

        $response->assertOk();
    }

    public function testJobIsDeletedSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $fakeJob = $this->returnFakeJob($category->id, $subCategory->id, $user->id);
        $job = $this->createJob($fakeJob);

        $response = $this->actingAs($user)->json('delete', 'api/buyer/jobs/' . $job->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'message' => []
                ]
            );
        $response->assertOk();
    }
}
