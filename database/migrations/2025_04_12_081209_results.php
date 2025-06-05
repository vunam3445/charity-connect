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
        Schema::create('results', function (Blueprint $table) {
            $table->uuid('result_id')->primary();
            $table->uuid('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade')->unique();
            $table->text('content');
            $table->text('images');
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
