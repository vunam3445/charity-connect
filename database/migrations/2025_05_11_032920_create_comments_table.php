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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->uuid('result_id');
            $table->uuid('volunteer_id')->nullable();
            $table->string('name');
            $table->text('content');
            $table->timestamps();

            $table->foreign('result_id')->references('result_id')->on('results')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('set null');
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
