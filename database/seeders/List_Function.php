<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class List_Function extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('list_functions')->delete();
        DB::table('list_functions')->truncate();

        DB::table('list_functions')->insert([
            ['id' => 1, 'list_name'  => 'Tạo Mới Tài Khoản'],
            ['id' => 2, 'list_name'  => 'Xem Danh Sách Tài Khoản'],
            ['id' => 3, 'list_name'  => 'Đổi Mật Khẩu Tài Khoản'],
            ['id' => 4, 'list_name'  => 'Cập Nhật Thông Tin Tài Khoản'],
            ['id' => 5, 'list_name'  => 'Xóa Tài Khoản'],
            ['id' => 6, 'list_name'  => 'View Tài Khoản'],
            ['id' => 7, 'list_name'  => 'View Quyền'],
            ['id' => 8, 'list_name'  => 'Xem Danh Sách Quyền'],
            ['id' => 9, 'list_name'  => 'Tạo Mới Quyền'],
            ['id' => 10, 'list_name'  => 'Xóa Quyền'],
            ['id' => 11, 'list_name'  => 'Cập Nhật Quyền'],
            ['id' => 12, 'list_name'  => 'View Nhà Cung Cấp'],
            ['id' => 13, 'list_name'  => 'Tạo Mới Nhà Cung Cấp'],
            ['id' => 14, 'list_name'  => 'Xem Danh Sách Nhà Cung Cấp'],
            ['id' => 15, 'list_name'  => 'Xóa Nhà Cung Cấp'],
            ['id' => 16, 'list_name'  => 'Cập Nhật Nhà Cung Cấp'],
            ['id' => 17, 'list_name'  => 'Đổi Trạng Thái Nhà Cung Cấp'],
            ['id' => 18, 'list_name'  => 'View Tiếp Thực'],
            ['id' => 19, 'list_name'  => 'Xem Danh Sách Tiếp Thực'],
            ['id' => 20, 'list_name'  => 'Cập Nhật Tiếp Thực'],
            ['id' => 21, 'list_name'  => 'Cập Nhập Tất Cả Tiếp Thực'],
            ['id' => 22, 'list_name'  => 'View Bếp'],
            ['id' => 23, 'list_name'  => 'Xem Danh Sách Bếp'],
            ['id' => 24, 'list_name'  => 'Cập Nhật Bếp'],
            ['id' => 25, 'list_name'  => 'Cập Nhật Tất Cả Bếp'],
            ['id' => 26, 'list_name'  => 'View Loại Khách Hàng'],
            ['id' => 27, 'list_name'  => 'Xem Danh Sách Loại Khách Hàng'],
            ['id' => 28, 'list_name'  => 'Xóa Loại Khách Hàng'],
            ['id' => 29, 'list_name'  => 'Thêm Mới Loại Khách Hàng'],
            ['id' => 30, 'list_name'  => 'Cập Nhật Loại Khách Hàng'],
            ['id' => 31, 'list_name'  => 'Tìm Kiếm Loại Khách Hàng'],
            ['id' => 32, 'list_name'  => 'Xóa Tất Cả Loại Khách Hàng'],
            ['id' => 33, 'list_name'  => 'View Khách Hàng'],
            ['id' => 34, 'list_name'  => 'Tạo Mới Khách Hàng'],
            ['id' => 35, 'list_name'  => 'Cập Nhật Khách Hàng'],
            ['id' => 36, 'list_name'  => 'Xóa Khách Hàng'],
            ['id' => 37, 'list_name'  => 'Tìm Khách Hàng'],
            ['id' => 38, 'list_name'  => 'Xem Danh Sách Khách Hàng'],
            ['id' => 39, 'list_name'  => 'Xóa Tất Cả Khách Hàng'],
            ['id' => 40, 'list_name'  => 'View Bán Hàng'],
            ['id' => 41, 'list_name'  => 'View Món Ăn'],
            ['id' => 42, 'list_name'  => 'Xem Danh Sách Món Ăn'],
            ['id' => 43, 'list_name'  => 'Đổi Trạng Thái Món Ăn'],
            ['id' => 44, 'list_name'  => 'Xóa Món Ăn'],
            ['id' => 45, 'list_name'  => 'Chỉnh Sửa Món Ăn'],
            ['id' => 46, 'list_name'  => 'Thêm Mới Món Ăn'],
            ['id' => 47, 'list_name'  => 'Cập Nhật Món Ăn'],
            ['id' => 48, 'list_name'  => 'Xóa Tất Cả Món Ăn'],
            ['id' => 49, 'list_name'  => 'View Danh Mục'],
            ['id' => 50, 'list_name'  => 'Xem Danh Sách Danh Mục'],
            ['id' => 51, 'list_name'  => 'Đổi Trạng Thái Danh Mục'],
            ['id' => 52, 'list_name'  => 'Xóa Danh Mục'],
            ['id' => 53, 'list_name'  => 'Cập Nhật Danh Mục'],
            ['id' => 54, 'list_name'  => 'Thêm Mới Danh Mục'],
            ['id' => 55, 'list_name'  => 'Xóa Tất Cả Danh Mục'],
            ['id' => 56, 'list_name'  => 'View Bàn'],
            ['id' => 57, 'list_name'  => 'Xem Danh Sách Bàn'],
            ['id' => 58, 'list_name'  => 'Đổi Trạng Thái Bàn'],
            ['id' => 59, 'list_name'  => 'Xóa Bàn'],
            ['id' => 60, 'list_name'  => 'Thêm Mới Bàn'],
            ['id' => 61, 'list_name'  => 'Cập Nhật Bàn'],
            ['id' => 62, 'list_name'  => 'Xóa Tất Cả Bàn'],
            ['id' => 63, 'list_name'  => 'View Khu Vực'],
            ['id' => 64, 'list_name'  => 'Xem Danh Sách Khu Vực'],
            ['id' => 65, 'list_name'  => 'Đổi Trạng Thái Khu Vực'],
            ['id' => 66, 'list_name'  => 'Xóa Khu Vực'],
            ['id' => 67, 'list_name'  => 'Xóa Tất Cả Khu Vực'],
            ['id' => 68, 'list_name'  => 'Thêm Mới Khu Vực'],
            ['id' => 69, 'list_name'  => 'Cập Nhật Khu Vực'],
            ['id' => 70, 'list_name'  => 'View Nhập Hàng'],
            ['id' => 71, 'list_name'  => 'Thêm Sản Phẩn Nhập Hàng'],
            ['id' => 72, 'list_name'  => 'Xác Nhận Nhập Hàng'],
            ['id' => 73, 'list_name'  => 'Danh Sách Nhập Hàng'],
        ]);
    }
}
