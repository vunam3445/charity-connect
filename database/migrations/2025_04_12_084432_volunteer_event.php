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
        Schema::create('volunteer_event', function (Blueprint $table) {
            $table->id('id');
            $table->uuid('event_id');  // Thêm cột event_id
            $table->uuid('volunteer_id');  // Thêm cột volunteer_id
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');  // Khóa ngoại với bảng events
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');  // Khóa ngoại với bảng volunteers
            $table->string('status');
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
