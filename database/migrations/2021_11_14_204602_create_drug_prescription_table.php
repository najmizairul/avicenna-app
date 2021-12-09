<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugPrescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_prescription', function (Blueprint $table) {
            $table->foreignId('drug_id');
            $table->foreignId('prescription_id')->primary();
            $table->string('dosage');
            $table->integer('daily_dose');
            $table->integer('duration');
            $table->date('starts_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_prescription');
    }
}
