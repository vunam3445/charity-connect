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
        Schema::create('follows', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID chính là UUID
            $table->uuid('volunteer_id');
            $table->uuid('organization_id');
            $table->timestamps();

            // Khóa ngoại
            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');
            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade');

            // Ràng buộc không cho phép follow trùng
            $table->unique(['volunteer_id', 'organization_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
