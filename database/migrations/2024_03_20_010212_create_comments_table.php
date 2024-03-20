<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('building_id');
            $table->unsignedInteger('user_id'); // Match the data type with the primary key in the `users` table
            $table->text('body');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
