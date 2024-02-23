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
        Schema::create('tblchude', function (Blueprint $table) {
            $table->unsignedInteger('IDCD')->autoIncrement();
            $table->string('TenChuDe', 200);
            $table->unsignedInteger('DanhMucID');
            $table->tinyInteger('TrangThaiCD');
            $table->timestamps();

            // Thiết lập foreign key
            $table->foreign('DanhMucID')->references('IDDM')->on('tbldanhmuc')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblchude');
    }
};
