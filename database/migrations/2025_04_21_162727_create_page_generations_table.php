<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('page_generations', function (Blueprint $table) {
            $table->id();
            $table->string('placement')->nullable();
            $table->string('slug')->nullable();
            $table->string('page_name')->nullable();
            $table->string('title')->nullable();
            $table->mediumText('description', 6000)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('page_generations');
    }
};
