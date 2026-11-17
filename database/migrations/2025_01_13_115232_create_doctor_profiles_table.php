<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id'); 
            $table->unsignedBigInteger('state_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->string('city', 50)->nullable();
            $table->string('address', 150)->nullable();
            $table->string('postal_code')->nullable();
            $table->string('specialization', 100)->nullable();
            $table->text('bio')->nullable();
            $table->text('qualification', )->nullable();
            $table->string('license_number', 60)->nullable();
            $table->string('profile_picture', 100)->nullable(); 
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->enum('availability_status', ['available', 'not_available'])->default('available');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_profiles');
    }
};
