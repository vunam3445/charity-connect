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
        //
        Schema::create('volunteers', function (Blueprint $table) {
            $table->uuid('volunteer_id')->primary();
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('point')->nullable();
            $table->string('role')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
