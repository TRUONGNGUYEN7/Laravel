<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tbldanhmuc', function (Blueprint $table) {
            $table->unsignedInteger('IDDM')->autoIncrement();
            $table->string('TenDanhMuc', 200);
            $table->tinyInteger('TrangThaiDM');
            $table->timestamps();
        });

        // Thêm dữ liệu cho các route của tbldanhmuc
        DB::table('grouppermission')->insert([
            [
                'name' => 'danhmuc',
                'displayName' => 'Danh mục',
            ],
        ]);

        // Lấy ID của group permission vừa thêm
        $groupPermissionID = DB::table('grouppermission')->where('name', 'danhmuc')->value('id');

        // Thêm dữ liệu cho các route của tbldanhmuc và liên kết với group permission
        DB::table('permissions')->insert([
            [
                'name' => 'admin.danhmuc.index',
                'displayName' => 'Xem danh mục',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.danhmuc.create',
                'displayName' => 'Tạo danh mục',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.danhmuc.xoa',
                'displayName' => 'Xóa danh mục',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.danhmuc.sua',
                'displayName' => 'Sửa danh mục',
                'groupPermissionID' => $groupPermissionID,
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('tbldanhmuc');
    }
    
};
