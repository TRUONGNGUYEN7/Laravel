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

         // Thêm dữ liệu cho các route của tbldanhmuc
        DB::table('grouppermission')->insert([
            [
                'name' => 'chude',
                'displayName' => 'Chủ đề',
            ],
        ]);

        // Lấy ID của group permission vừa thêm
        $groupPermissionID = DB::table('grouppermission')->where('name', 'chude')->value('id');

        // Thêm dữ liệu cho các route của tbldanhmuc và liên kết với group permission
        DB::table('permissions')->insert([
            [
                'name' => 'admin.chude.index',
                'displayName' => 'Xem chủ đề',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.chude.create',
                'displayName' => 'Tạo chủ đề',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.chude.xoa',
                'displayName' => 'Xóa chủ đề',
                'groupPermissionID' => $groupPermissionID,
            ],
            [
                'name' => 'admin.chude.sua',
                'displayName' => 'Sửa chủ đề',
                'groupPermissionID' => $groupPermissionID,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblchude');
    }
};
