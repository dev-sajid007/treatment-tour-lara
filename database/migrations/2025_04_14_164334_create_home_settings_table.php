<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();
            $table->string('top_title', 80)->nullable();
            $table->string('top_sub_title', 120)->nullable();
            $table->string('top_description', 255)->nullable();
            $table->string('top_image', 80)->nullable(); //image will upload in public path
            $table->string('about_title', 80)->nullable();
            $table->string('about_sub_title', 80)->nullable();
            $table->string('about_description', 255)->nullable();
            $table->string('about_button', 80)->nullable();
            $table->string('package_title', 80)->nullable();
            $table->string('podcast_title', 80)->nullable();
            $table->string('news_event_title', 80)->nullable();

            $table->string('faq_title', 80)->nullable();
            $table->string('faq_sub_title', 80)->nullable();
            $table->string('video', 80)->nullable(); //link will add

            $table->string('why_choose_title', 80)->nullable();
            $table->string('why_choose_des', 255)->nullable();
            $table->string('first_card_title', 80)->nullable();
            $table->mediumText('first_card_des', 1000)->nullable();
            $table->string('first_card_button', 80)->nullable();

            $table->string('second_card_title', 80)->nullable();
            $table->mediumText('second_card_des', 1000)->nullable();
            $table->string('second_card_button', 80)->nullable();


            $table->string('third_card_title', 80)->nullable();
            $table->mediumText('third_card_des', 1000)->nullable();
            $table->string('third_card_button', 80)->nullable();

            $table->string('footer_title', 80)->nullable();
            $table->mediumText('footer_des', 1000)->nullable();
            $table->mediumText('footer_logo_des', 1000)->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
