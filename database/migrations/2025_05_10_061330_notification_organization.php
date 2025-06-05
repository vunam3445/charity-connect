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
        Schema::create('notifications_organization', function (Blueprint $table) {
            $table->id(); // tự tăng
            $table->uuid('notification_id');
            $table->uuid('organization_id');

            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_read')->default(false);
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
