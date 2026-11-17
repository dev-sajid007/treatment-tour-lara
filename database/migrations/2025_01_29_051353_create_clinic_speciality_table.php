<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('clinic_speciality', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_id'); 
            $table->foreign('clinic_id')->references('id')->on('clinics');
            $table->unsignedBigInteger('speciality_id'); 
            $table->foreign('speciality_id')->references('id')->on('specialities');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('clinic_speciality');
    }
};
