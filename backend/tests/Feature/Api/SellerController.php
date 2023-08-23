<?php

namespace Tests\Feature\Api;

use Illuminate\Http\Response;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class SellerControllerTest extends TestCase
{


    public function testEarningsAreReturnedInValidFormat()
    {
        $buyer = $this->createUser(true);
        $seller = $this->createUser(true);
        $category = $this->createCategory();
        $subCategory = $this->createSubCategory($category->id);
        $this->becomeSeller($category->id, $subCategory->id, $seller);
        $payment = $this->createPayment();
        $service = $this->createService($category->id, $subCategory->id, $seller->id);
        //$this->createFakeOrder($buyer, $seller, $service, $payment);
        $response = $this->actingAs($seller)->json('get', 'api/seller/getEarnings')
            ->assertStatus(Response::HTTP_OK);


        $response->assertJson(fn (AssertableJson $json)=>
            $json->whereAllType($this->returnEarningsResponse()) );
    }


    private function returnEarningsResponse(){
        return [
            "id"=>"string",
            "name"=> "string",
            "username"=>"string",
            "image"=> "string",
            "created_at"=> "string",
            "address"=> "string",
            "email"=> "string",
            "description"=>"string",
            "phone"=>"string",
            "isFreelancer"=>"integer",
            "total_reviews"=>"integer",
            "user_rating"=>"double|integer",
            "recent_delivery"=>"string",
            "user_languages"=>"string",
            "user_skills"=>"array",
            "pending_balance"=>"double|integer|string",
            "availabe_balance"=>"double|integer|string",
            "cancelled_orders"=>"double|integer|string",
            "cancelled_orders_balance"=>"double|integer|string",
            "active_orders"=>"double|integer|string",
            "active_orders_balance"=>"double|integer|string",
            "monthly_selling"=>"integer|string",
            'weekly_clicks'=>"string|integer",
            'weekly_impression'=>"string|integer",
            'analytics'=>"array",
            "average_selling"=>"double|integer|string",
            "payments_enabled"=>"boolean"

        ];
    }
}
