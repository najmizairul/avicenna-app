<?php

namespace Database\Factories;

use App\Actions\GenerateUniqueID;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'ic' => $this->faker->date('Ymd') . '-' . str_pad(random_int(1,14), 2, '0', STR_PAD_LEFT) .'-' .  random_int(1000,9999), //GenerateICNumber::run(),
            'rn' => GenerateUniqueID::rnNumber(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'dob' => now()->subYears(random_int(18,99))->format('Y-m-d'),
            'address' => $this->faker->address(),
            'sex' => $this->faker->randomElement(['male','female']),
            'last_visited_at' => now()->subDays(random_int(7,99)),

        ];
    }
}
