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
        Schema::create('notifications_organization_reads', function (Blueprint $table) {
            $table->id();
            $table->uuid('notification_id');
            $table->uuid('organization_id');
            $table->boolean('is_read')->default(false); // ✅ sửa ở đây

            $table->foreign('notification_id')->references('notification_id')->on('notifications_organization_all')->onDelete('cascade');
            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade');
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
