<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceCategory;
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
            'service_name' => ucfirst($this->faker->text(15)),
            'service_category_id' => ServiceCategory::all()->random(),
            'price' => $this->faker->randomElement([100, 200, 300,400,500]),
            'description' => $this->faker->text(20),
            'service_image' => $this->faker->text(20) . '.jpg',
        ];
    }

}
