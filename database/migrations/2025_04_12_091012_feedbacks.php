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
        Schema::create('feedback', function (Blueprint $table) {
            $table->uuid('feedback_id')->primary();  // Sử dụng uuid làm khóa chính
            $table->uuid('event_id');  // Cột event_id
            $table->uuid('volunteer_id');  // Cột volunteer_id
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');  // Khóa ngoại với bảng events
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');  // Khóa ngoại với bảng volunteers
            $table->text('content');
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
