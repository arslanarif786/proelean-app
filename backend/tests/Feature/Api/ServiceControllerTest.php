<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testServiceIsCreatedSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $user);
        $payload = $this->returnFakeService($category->id, $subCategory->id, $user->id);
        $response = $this->actingAs($user)->json('post', 'api/seller/services', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => $this->returnFakeServiceResource()
                ]
            );
        $response->assertJson(fn (AssertableJson $json)=>
        $json
            ->has('data',fn ($json) =>
            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->whereAllType($this->returnFakeServiceResourceTypes()) )
            );
        unset($payload['banner']);
        $this->assertDatabaseHas('services', $payload);
    }

    public function testServicesAreReturnedInValidFormat()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $user);
        $payload = $this->createService($category->id, $subCategory->id, $user->id);

        $response = $this->actingAs($user)->json('get', 'api/seller/services')
            //  ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->returnFakeServiceResource()
                    ]
                ]
            );
        unset($payload['banner']);
        $response->assertJson(fn (AssertableJson $json)=>
        $json->has('meta')
            ->has('links')
            ->has('data.0',fn ($json) =>
            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->whereAllType($this->returnFakeServiceResourceTypes()) )
            );
        $response->assertOk();
    }

    public function testServiceIsShownSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $user);
        $payload = $this->createService($category->id, $subCategory->id, $user->id);

        $response = $this->actingAs($user)->json('get', 'api/seller/services/' . $payload->id)
            //  ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => $this->returnFakeServiceResource()
                ]
            );

        $response->assertJson(fn (AssertableJson $json)=>
        $json
            ->has('data',fn ($json) =>
            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->whereAllType($this->returnFakeServiceResourceTypes()) )
            );
        $response->assertOk();
    }

    public function testServiceIsUpdatedSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $user);
        $payload = $this->createService($category->id, $subCategory->id, $user->id);
        $dataToBeUpdate = $this->returnFakeService($category->id, $subCategory->id, $user->id);

        $response = $this->actingAs($user)->json('put', 'api/seller/services/' . $payload->id, $dataToBeUpdate)
            //  ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => $this->returnFakeServiceResource()
                ]
            );
        unset($dataToBeUpdate['banner']);

        $response->assertJson(fn (AssertableJson $json)=>
        $json
            ->has('data',fn ($json) =>
            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->whereAllType($this->returnFakeServiceResourceTypes()) )
            );
        $response->assertOk();
    }

    public function testServiceIsDeletedSuccessfully()
    {
        $user = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $user);
        $service = $this->createService($category->id, $subCategory->id, $user->id);

        $response = $this->actingAs($user)->json('delete', 'api/seller/services/' . $service->id)
            //  ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message' => []
                ]
            );
        $response->assertOk();
    }

    private function returnFakeServiceResource()
    {
        return [
            'id',
            's_description',
            'description',
            'price',
            'lat',
            'lng',
            'revision',
            'delivery_time',
            'additional_info',
            'slug',
            'service_media',
        ];
    }
}
