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
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('organization_id')->primary();
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('address');
            $table->string('phone');
            $table->date('founded_at'); // Ngày thành lập
            $table->string('representative');
            $table->text('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('website')->nullable();
            $table->string('approved')->default('pending');
            $table->string('role');
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
