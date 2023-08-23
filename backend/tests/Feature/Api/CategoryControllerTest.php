<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetServicesBySubCategoryIdAreReturnInCorrectFormat()
    {
        $seller = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $seller);
        $this->createService($category->id, $subCategory->id, $seller->id);
        $payload=$this->returnFakeService($category->id, $subCategory->id, $seller->id);

        $user = $this->createUser(true);
        $user=Sanctum::actingAs($user);

        $response=$this->json('get', 'api/categories/'.$subCategory->id.'/services')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->returnFakeServiceResource()
                    ]
                ]
            );

        $response->assertJson(function (AssertableJson $json){
        $json->has('meta')
            ->has('links')
            ->has('data')
            ->whereType('data','array', function ($json) {

            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->has('service_reviews')
                ->whereAllType($this->returnFakeServiceResourceTypes());
            });
        });
        $response->assertOk();
    }

    public function testIsSearchApiReturnDataInCorrectFormat()
    {
        $seller = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $seller);
        $this->createService($category->id, $subCategory->id, $seller->id);
        $payload=$this->returnFakeService($category->id, $subCategory->id, $seller->id);

        $user = $this->createUser(true);
        $user=Sanctum::actingAs($user);

        $response=$this->json('get', 'api/search?q='.$category->title)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => $this->returnFakeServiceResource()
                    ]
                ]
            );

        $response->assertJson(function (AssertableJson $json) {
        $json->has('meta')
            ->has('links')
            ->has('data')
            ->whereType('data','array',function ($json) {
            $json->has('category')
                ->has('sub_category')
                ->has('service_user')
                ->has('service_media')
                ->has('service_reviews')
                ->whereAllType($this->returnFakeServiceResourceTypes());
             });
            });
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
            'favourite',
            'service_rating',
            'total_orders',
            'total_reviews',
            'total_clicks',
        ];
    }
}
