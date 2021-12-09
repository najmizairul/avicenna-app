<?php

namespace Database\Factories;

use App\Actions\GenerateUniqueID;
use App\Models\Drug;
use App\Models\DrugPrescription;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class DrugPrescriptionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DrugPrescription::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'drug_id' => Drug::inRandomOrder()->first() ?? Drug::factory(),
        'prescription_id' => Prescription::inRandomOrder()->first() ?? Prescription::factory(),
       'dosage' => mt_rand(1,5) . " mg",
       'daily_dose' => mt_rand(1,3),
        'duration' => mt_rand(10, 30),
        'starts_at' => now()->addDays(mt_rand(1,10))

        ];
    }
}
