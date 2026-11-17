<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('treatment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name'); 
            $table->unsignedBigInteger('treatment_category_id');
            $table->foreign('treatment_category_id')->references('id')->on('treatment_categories')->onDelete('cascade');

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->string('image', 100)->nullable(); 
            $table->mediumText('description', 2000)->nullable(); 
            $table->decimal('price', 10, 2); 
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('treatment_packages');
    }
};
