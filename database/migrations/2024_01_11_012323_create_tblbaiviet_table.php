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
        Schema::create('tblbaiviet', function (Blueprint $table) {
            $table->id('IDBV');
            $table->string('TenBV', 200);
            $table->text('Mota');
            $table->text('NoiDung');
            $table->string('HinhAnh', 500);
            $table->string('NguoiDangBV', 70);
            $table->unsignedInteger('ChuDeID');
            $table->integer('LuotXem');
            $table->tinyInteger('TrangThaiBV');
            $table->datetime('ThoiGianBV');
            $table->timestamps();

             // Thiết lập foreign key
            $table->foreign('ChuDeID')->references('IDCD')->on('tblchude')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblbaiviet');
    }
};
