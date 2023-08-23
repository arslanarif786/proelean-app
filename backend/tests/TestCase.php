<?php

namespace Tests;

use App\Models\Category;
use App\Models\Country;
use App\Models\Job;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase, WithFaker;

    public function createUser($password = false, $isSeller = 0)
    {

        $fakeUser = $this->returnFakeUser($password, $isSeller);
        $fakeUser['password'] = bcrypt($fakeUser['password']);
        return User::create($fakeUser);
    }

    public function returnFakeUser($password = true, $isSeller = 0)
    {
        $payload = [
            'name' => $this->faker->firstName . " " . $this->faker->lastName,
            'email'      => $this->faker->unique()->safeEmail,
            'username' => $this->faker->firstName."asd",
            'isFreelancer' => $isSeller
        ];

        if ($password) {
            $payload['password']  = '12345678';
        }

        return $payload;
    }

    public function createService($categoryID, $subCategoryID, $userID)
    {
        return Service::create(
            $this->returnFakeService($categoryID, $subCategoryID, $userID)
        );
    }

    public function createJob($fakeJob)
    {
        return Job::create($fakeJob);
    }

    public function createCategory()
    {

        return Category::create(
            $this->returnFakeCategory()
        );
    }

    public function createSubCategory($categoryID)
    {

        return SubCategory::create(
            $this->returnFakeSubCategory($categoryID)
        );
    }

    public function createCountry()
    {

        return Country::create( $this->returnFakeCountryResource());
    }

    public function returnFakeCategory()
    {
        $payload = [
            'title' => $this->faker->firstNameFemale,
            'description' => "sdfasd fasdfasdfasd fsdfasdf sdfasdfasdf",
        ];

        return $payload;
    }
    public function returnFakeSubCategory($categoryID)
    {
        $payload = [
            'category_id' => $categoryID,
            'description' => "sdfasd fasdfasdfasd fsdfasdf sdfasdfasdf",
            'title' => $this->faker->firstNameFemale,
        ];

        return $payload;
    }
    public function returnFakeJob($categoryID, $subCategoryID, $userID)
    {
        $payload = [
            'user_id' => $userID,
            'category_id' => $categoryID,
            'sub_category_id' => $subCategoryID,
            'description' => 'sdfa sdfsfej sdfjj23 sdfjasdnfj sdf klmlk lkml',
            'delivery_time' => '12 days',
            'budget' => 35.5,
        ];

        return $payload;
    }

    public function returnFakeBecomeSeller($categoryID, $subCategoryID,$countryID)
    {
        Storage::fake('images');
        return [
            'freelancer_title' => $this->faker->sentence,
            'category_id' => $categoryID,
            'country_id' => $countryID,
            'sub_category_id' => $subCategoryID,
            'description' => 'asd sdjkfnjk 34jnjnerf sekjfnasdjknf 3jnjknafjkasd ',
            'cinic' => UploadedFile::fake()->image('avator.jpg'),
            'availability' => "part time",
            'lang' => "English",
            'facebook' => 'fb.com',
            'linked_in' => "linked_in.com",
            'portfolio' => 'https://waheed.com',
            'google_plus' => 'google_plus.com',
            'twitter' => 'twitter.com',
            'instagram' => 'instagram.com',
        ];
    }

    public function returnFakeService($categoryID, $subCategoryID, $userID)
    {
        Storage::fake('images');

        $payload = [
            'user_id' => $userID,
            'category_id' => $categoryID,
            'sub_category_id' => $subCategoryID,
            'description' => 'sdfasd sdfkkwenkw eksdmfksdk sdfjnasdjkfnjkas',
            's_description' => 'sdfjkjknjk sdfjkjsd fksndfjsdjk',
            'price' => 45.4,
            'revision' => 3,
            'delivery_time' => '35 days',
            'additional_info' => $this->faker->text(50),
            'banner' => [UploadedFile::fake()->image('avatar.jpg')]
        ];

        return $payload;
    }

    public function becomeSeller($categoryID, $subCategoryID, $user)
    {
        $country=$this->createCountry();
        $payload = $this->returnFakeBecomeSeller($categoryID, $subCategoryID,$country->id);
        $country=$this->createCountry();
        $payload['country_id']=$country->id;
        $this->actingAs($user)->json('post', 'api/become_freelancer', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message' => []
                ]
            );
        $payload['user_id'] = $user->id;
        $payload['balance'] = 0.0;
        //    $this->assertDatabaseHas('user_details', $payload);
    }

    public function returnFakeJobResource()
    {
        return [
            'id',
            'user_id',
            'category_id',
            'sub_category_id',
            'description',
            'delivery_time',
            'budget',
            'cinic',
            'featured',
            'latitude',
            'longitude',
            'total_offers',
            'is_applied',
            'created_at',
        ];
    }

    public function returnFakeCountryResource()
    {
        return [
        "name" =>"Pakistan",
        "iso3" =>"pak",
        "numeric_code"=>"pak",
        "iso2"=>"pak",
        "phonecode"=>"pak",
        "capital"=>"pak",
        "currency"=>"pak",
        "currency_symbol"=>"pak",
        "tld"=>"pak",
        "native"=>"pak",
        "region"=>"pak",
        "subregion"=>"pak",
        "timezones"=>"pak",
        "translations"=>"pak",
        "latitude"=>"pak",
        "longitude"=>"pak",
        "emoji"=>"pak",
        "emojiU"=>"pak",
        "flag"=>"pak",
        "wikiDataId"=>"pak"
        ];
    }

    public function returnFakeJobResourceTypes(){
        return [
            'id'=>'string',
            'user_id'=>'string',
            'category_id'=>'string',
            'slug'=>'string',
            'sub_category_id'=>'string',
            'description'=>'string',
            'delivery_time'=>'string',
            'budget'=>'double',
            'cinic'=>'string',
            'featured'=>'integer',
            'latitude'=>'integer',
            'longitude'=>'integer',
            'total_offers'=>'integer',
            'is_applied'=>'integer',
            'created_at'=>'string',
        ];
    }

    public function returnFakeServiceResourceTypes(){
        return [
            "id"=>"string",
            "s_description"=> "string",
            "description"=> "string",
            "price"=> "double",
            "slug" => "string",
            "favourite"=> "integer",
            "service_rating"=> "double|integer",
            "lat"=> "double|integer",
            "lng"=> "double|integer",
            "revision"=> "integer",
            "total_orders"=> "integer",
            "total_reviews"=> "integer",
            "total_clicks"=> "integer",
            "delivery_time"=> "string",
            "additional_info"=> "string",
            'offered_services' => 'array'
        ];
    }


    protected function createPayment(){
        $fakePayment=$this->returnFakePayment();
        return Payment::create($fakePayment);
    }

    protected function returnFakePayment(){
        // $order = $this->returnFakeOrder();
        return  [
            'txn_id' => 'ch_3KADkKEo1VO7fqoo1pWNFHy' .rand(1,99),
            'brand' => 'visa',
            'currency'=>'usd',
            'amount'=>rand(10,100),
            'raw_response'=>'{"card":"test"}'
        ];
    }

    protected function createFakeOrder(User $buyer, User $seller,Service $service,Payment $payment,$job=null){
        $fakeOrder=$this->returnFakeOrder($buyer,$seller,$service,$payment,$job);
        return Order::create($fakeOrder);
    }

    protected function returnFakeOrder(User $buyer,User $seller,Service $service,Payment $payment,$job=null) :array {
        return [
            'user_id'=>$buyer->id,
            'seller_id'=>$seller->id,
            'service_id'=>$service->id,
            'job_id'=>$job?->id,
            'amount'=>$payment->amount,
            'payment_id'=>$payment->id,
            'status'=>1,
            'pre_status'=>1,
            'orderNo'=> rand(1000000,9999999),
            'type'=>'custom',
            'revision'=>0,
            'delivery_time'=>rand(1,20). " days",
            'status_id'=>1,
            'payment_method'=>'stripe',
            'description'=> "sdfasd fasdf asd gsdgasgsdg sdgs sdfasd",
            'currency'=>$payment->currency,
        ];
    }


}
