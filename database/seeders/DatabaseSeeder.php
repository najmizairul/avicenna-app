<?php

namespace Database\Seeders;

use App\Models\Drug;
use App\Models\DrugPrescription;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('settings.roles') as $role) {
            User::factory(3)->create(['role' => $role]);
        }

        Drug::factory(10)->create();

        Patient::factory(10)->create()->each(function ($patient) {
            PatientVisit::factory(mt_rand(2,5))->create([
                'patient_id' => $patient->id,
                'referrer_id' => User::inRandomOrder()->where('role', 'receptionist')->first(),
                'user_id' => User::inRandomOrder()->where('role', 'doctor')->first(),
            ])->each(function ($visit) use ($patient) {
//                Prescription::factory()->create([
//                    'patient_id' => $patient->id,
//                    'patient_visit_id' => $visit->id
//                ])->each(function($prescription) {
//
//                });
            });
        });

       // DrugPrescription::factory()->create();

    }
}
