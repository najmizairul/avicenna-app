<?php

namespace Database\Factories;

use App\Actions\GenerateUniqueID;
use App\Models\Drug;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prescription::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>  User::inRandomOrder()->where('role', 'doctor')->first() ?? User::factory(),
        'patient_id' =>  Patient::inRandomOrder()->first() ?? Patient::factory(),
        'patient_visit_id' =>  PatientVisit::inRandomOrder()->first() ??  PatientVisit::factory(),
        'status' => $this->faker->randomElement(['waiting', 'active', 'closed']),
        'code' => null,
        'collected_at' => null,

        ];
    }
}
