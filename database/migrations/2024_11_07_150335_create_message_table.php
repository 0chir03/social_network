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
        Schema::create('messages', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('subscriber_id');
            $table->foreign('subscriber_id')->references('id')->on('subscribers');
            $table->integer('user_id');
            $table->dateTime('date_time');
            $table->text('text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
