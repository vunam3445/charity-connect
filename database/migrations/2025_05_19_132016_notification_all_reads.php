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
        Schema::create('notification_all_reads', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id');
            $table->uuid('volunteer_id')->nullable();
            $table->uuid('organization_id')->nullable();
            $table->boolean('is_read')->default(false); // ✅ sửa ở đây

            $table->foreign('notification_id')->references('notification_id')->on('notifications_all')->onDelete('cascade');
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
