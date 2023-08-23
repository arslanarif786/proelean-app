<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => 1,
            "category_id" => $this->faker->numberBetween(1,6),
            "sub_category_id" => 1,
            "s_description" => $this->faker->title(),
            "description" => $this->faker->paragraph(),
            'price'=>$this->faker->numberBetween(50.25,200.50),
            'delivery_time'=>$this->faker->numberBetween(1,365).' days',
            'additional_info'=>$this->faker->paragraph(),
            'featured'=>$this->faker->randomElement([1,0]),
            'rating'=>$this->faker->numberBetween(1,5),
        ];
    }
}
