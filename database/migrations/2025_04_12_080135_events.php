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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('event_id')->primary();
            $table->uuid('organization_id');  // Thêm cột organization_id
            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('location');
            $table->integer('min_quantity');
            $table->integer('max_quantity');
            $table->integer('quantity_now');
            $table->text('note')->nullable();
            $table->string('status')->default('active');
            $table->string('approved')->default('pending');
            $table->json('images')->nullable();
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
