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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('account_id');
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->boolean('accepted');
            $table->timestamps();
        });
    }

        /**
         * Reverse the migrations.
         */
        public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
