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
        Schema::create('tblbinhluan', function (Blueprint $table) {
            $table->unsignedInteger('IDBL')->autoIncrement();
            $table->string('Noidung', 100);
            $table->string('Email', 50);
            $table->unsignedInteger('UserID');
            $table->timestamps();

            $table->foreign('UserID')->references('IDUS')->on('tbluser')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblbinhluan');
    }
};
