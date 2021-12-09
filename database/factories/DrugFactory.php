<?php

namespace Database\Factories;

use App\Models\Drug;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrugFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drug::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
           'name' => $this->faker->word(),
            'manufacturer' => $this->faker->company(),
            'sku' =>  $this->faker->iban(),
            'quantity' => mt_rand(10,100),
            'expires_at' => now()->addYears(mt_rand(1,5)),

        ];
    }
}
