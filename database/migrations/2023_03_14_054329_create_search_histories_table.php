<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->string('keyword');
            $table->string('search_time');
            $table->json('search_results');
            $table->integer('total_results')->default(1);
            $table->string('search_engine')->nullable();
            $table->string('search_type')->nullable();
            $table->string('user_name')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('device_type')->nullable();
            $table->string('browser_type')->nullable();
            $table->string('language')->nullable();
            $table->string('clicked_result')->nullable();
            $table->string('time_spent')->nullable();
            $table->boolean('is_section_active')->default(false);
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
        Schema::dropIfExists('search_histories');
    }
};
