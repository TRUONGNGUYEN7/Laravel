<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Thêm dòng này

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Thêm dữ liệu mẫu
        DB::table('roles')->insert([
            'name' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo dữ liệu cho bảng grouppermission
        DB::table('grouppermission')->insert([
            [
                'name' => 'danhmuc',
                'displayName' => 'Danh mục',
                'status' => 'active'
            ],
        ]);
        $groupPermissionID = DB::table('grouppermission')->where('name', 'danhmuc')->value('id');
        // Thêm dữ liệu cho bảng permissions và liên kết với group permission
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

        // Thêm dữ liệu mẫu admin
        DB::table('admin')->insert([
            'name' => 'admin',
            'fullName' => 'Nguyễn Nhật Trường',
            'email' => 'nguyentruongtv2001@gmail.com',
            'password' => '$2y$12$F69zIspA869u5FgIdL33KOILx9amtC65mkSh7EYdjiBEZ/Y.vq4Mm',
            'status' => 'active',
            'roleID' => '1',
        ]);

        // Tạo dữ liệu cho bảng grouppermission
        DB::table('grouppermission')->insert([
            [
                'name' => 'chude',
                'displayName' => 'Chủ đề',
                'status' => 'active'
            ],
        ]);

        // Lấy ID của group permission vừa thêm
        $groupPermissionChuDeID = DB::table('grouppermission')->where('name', 'chude')->value('id');

        // Thêm dữ liệu cho bảng permissions và liên kết với group permission cho chủ đề
        DB::table('permissions')->insert([
            [
                'name' => 'admin.chude.index',
                'displayName' => 'Xem chủ đề',
                'groupPermissionID' => $groupPermissionChuDeID,
            ],
            [
                'name' => 'admin.chude.create',
                'displayName' => 'Tạo chủ đề',
                'groupPermissionID' => $groupPermissionChuDeID,
            ],
            [
                'name' => 'admin.chude.xoa',
                'displayName' => 'Xóa chủ đề',
                'groupPermissionID' => $groupPermissionChuDeID,
            ],
            [
                'name' => 'admin.chude.sua',
                'displayName' => 'Sửa chủ đề',
                'groupPermissionID' => $groupPermissionChuDeID,
            ],
        ]);

        // Tạo dữ liệu cho bảng grouppermission
        DB::table('grouppermission')->insert([
            [
                'name' => 'baiviet',
                'displayName' => 'Bài viết',
                'status' => 'active'
            ],
        ]);

        // Lấy ID của group permission vừa thêm
        $groupPermissionBaiVietID = DB::table('grouppermission')->where('name', 'baiviet')->value('id');

        // Thêm dữ liệu cho bảng permissions và liên kết với group permission cho bài viết
        DB::table('permissions')->insert([
            [
                'name' => 'admin.baiviet.index',
                'displayName' => 'Xem bài viết',
                'groupPermissionID' => $groupPermissionBaiVietID,
            ],
            [
                'name' => 'admin.baiviet.create',
                'displayName' => 'Tạo bài viết',
                'groupPermissionID' => $groupPermissionBaiVietID,
            ],
            [
                'name' => 'admin.baiviet.xoa',
                'displayName' => 'Xóa bài viết',
                'groupPermissionID' => $groupPermissionBaiVietID,
            ],
            [
                'name' => 'admin.baiviet.sua',
                'displayName' => 'Sửa bài viết',
                'groupPermissionID' => $groupPermissionBaiVietID,
            ],
        ]);

    }
}
