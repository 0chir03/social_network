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
        Schema::create('accounts', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->enum('marital_status', ['холост', 'женат', 'не замужем', 'замужем', 'в активном поиске', 'есть парень', 'есть девушка'])->nullable();
            $table->string('locality');
            $table->string('career');
            $table->string('hobby');
            $table->string('photo_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
