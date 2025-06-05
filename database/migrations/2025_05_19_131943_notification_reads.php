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
        Schema::create('notification_reads', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id');
            $table->uuid('volunteer_id');
            $table->boolean('is_read')->default(false); // ✅ sửa ở đây

            $table->foreign('notification_id')->references('notification_id')->on('notifications')->onDelete('cascade');
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');
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
