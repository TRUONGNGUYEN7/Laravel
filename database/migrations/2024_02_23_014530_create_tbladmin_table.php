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

        // Thêm dữ liệu mẫu
        DB::table('tbladmin')->insert([
            'Name' => 'admin',
            'Hoten' => 'Nguyễn Nhật Trường',
            'Email' => 'nguyentruongtv2001@gmail.com',
            'MatKhau' => '202cb962ac59075b964b07152d234b70',
            'TrangThai' => 1,
            'roleID' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbladmin');
    }
};
