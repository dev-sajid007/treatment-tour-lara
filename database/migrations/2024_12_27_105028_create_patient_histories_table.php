<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            // Guardian Information
            $table->string('guardian_name')->nullable(); // Name of the guardian
            $table->string('guardian_relationship')->nullable(); // Relationship to the patient (e.g., Father, Mother, Spouse)
            $table->string('guardian_contact_number')->nullable(); // Contact number of the guardian
            $table->string('guardian_email')->nullable();

            $table->text('medical_conditions')->nullable(); // Chronic diseases or conditions
            $table->text('medications')->nullable(); // Ongoing medications
            $table->text('allergies')->nullable(); // Allergies to medicines, foods, etc.
            $table->text('surgical_history')->nullable(); // Previous surgeries
            $table->text('family_history')->nullable(); // Family history of diseases
            $table->text('social_history')->nullable(); // Smoking, alcohol, drug use, etc.
            $table->text('vaccination_history')->nullable(); // Vaccinations received
            $table->text('disease_history')->nullable(); // Past diseases (e.g., heart disease, diabetes)
            $table->text('past_treatments')->nullable(); // Past treatments or therapies
            $table->text('mental_health_history')->nullable(); // Mental health conditions or history
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_histories');
    }
};
