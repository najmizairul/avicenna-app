<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->nullable();
            $table->foreignId('patient_id');
            $table->foreignId('referrer_id');
            $table->foreignId('user_id');
            $table->string('diagnosis')->nullable();
            $table->string('complaints')->nullable();
            $table->string('notes')->nullable();
            $table->enum('status', ['waiting', 'active', 'closed'])->default('waiting');
            $table->timestamp('visited_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_visits');
    }
}
