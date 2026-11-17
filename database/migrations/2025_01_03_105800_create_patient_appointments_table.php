<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('patient_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->nullable(); // Foreign key for patients
            $table->unsignedBigInteger('doctor_id')->nullable();  // Foreign key for doctors
            $table->unsignedBigInteger('clinic_id')->nullable();  // Foreign key for clinics
            $table->unsignedBigInteger('hospital_id')->nullable();  // Foreign key for hospital
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->date('appointment_date');         // Appointment date
            $table->time('appointment_time');         // Appointment time
            $table->enum('status', ['scheduled', 'completed', 'canceled'])->default('scheduled'); // Status
            $table->text('reason')->nullable();       // Reason for appointment
            $table->timestamps();                    // Created and updated timestamps
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('patient_appointments');
    }
};
