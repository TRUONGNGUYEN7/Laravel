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
        Schema::create('tbldanhmuc', function (Blueprint $table) {
            $table->unsignedInteger('IDDM')->autoIncrement();
            $table->string('TenDanhMuc', 200);
            $table->tinyInteger('TrangThaiDM');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbldanhmuc');
    }
};
