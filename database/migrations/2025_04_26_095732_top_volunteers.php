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
        Schema::create('top_volunteers', function (Blueprint $table) {
            $table->id('id')->primary();  // Sử dụng uuid làm khóa chính
            $table->uuid('volunteer_id');
            $table->integer('participation_count');
            $table->integer('quarter'); // quý (1,2,3,4)
            $table->integer('year');
            $table->timestamps();

            $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');  // Khóa ngoại với bảng volunteers

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
