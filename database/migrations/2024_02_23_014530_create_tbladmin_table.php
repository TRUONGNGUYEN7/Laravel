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
        Schema::create('tbladmin', function (Blueprint $table) {
            $table->unsignedInteger('IDAD')->autoIncrement();
            $table->string('Name', 200);
            $table->string('Hoten', 200);
            $table->string('Email', 50);
            $table->string('MatKhau', 200);
            $table->longText('roleID')->nullable();
            $table->tinyInteger('TrangThai');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbladmin');
    }
};
