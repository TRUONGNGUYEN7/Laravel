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

         // Thêm dữ liệu cho các route của tbldanhmuc
        DB::table('grouppermission')->insert([
            [
                'name' => 'baiviet',
                'displayName' => 'Bài viết',
            ],
        ]);

        // Lấy ID của group permission vừa thêm
        $groupPermissionID = DB::table('grouppermission')->where('name', 'baiviet')->value('id');

        // Thêm dữ liệu cho các route của tblbaiviet và liên kết với group permission
        DB::table('permissions')->insert([
            [
                'name' => 'admin.baiviet.index',
                'displayName' => 'Xem bài viết',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.baiviet.create',
                'displayName' => 'Tạo bài viết',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.baiviet.xoa',
                'displayName' => 'Xóa bài viết',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.baiviet.sua',
                'displayName' => 'Sửa bài viết',
                'groupPermissionID' => $groupPermissionID,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblbaiviet');
    }
};
