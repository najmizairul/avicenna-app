<?php

namespace Database\Factories;

use App\Models\Drug;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientVisitFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PatientVisit::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prescription_id' =>  Prescription::inRandomOrder()->first() ?? Prescription::factory(),
        'patient_id' =>  Patient::inRandomOrder()->first() ?? Patient::factory(),
        'referrer_id' =>  User::inRandomOrder()->where('role', 'receptionist')->first() ?? User::factory(),
        'user_id' =>  User::inRandomOrder()->where('role', 'doctor')->first() ??  User::factory(),
        'diagnosis' => $this->faker->sentence(),
        'complaints' => $this->faker->sentence(),
        'notes' => $this->faker->sentence(),
        'status' => $this->faker->randomElement(['waiting', 'active', 'closed']),
       'visited_at' => now()->subDays(random_int(7,99)),

        ];
    }
}
