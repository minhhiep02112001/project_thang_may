<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permissions')->delete();
        DB::statement("ALTER TABLE permissions AUTO_INCREMENT =  1");

        $moduls = [
            [
                "title" => "Quản lý danh mục",
                "name" => "danh mục",
                "key" => 'categories',
            ], [
                "title" => "Quản lý Banner",
                "name" => "banner",
                "key" => 'banners',
            ], [
                "title" => " Quản Lý Nhà Cung Cấp",
                "name" => "nhà cung cấp",
                "key" => 'vendors'
            ], [
                "title" => "Quản Lý Thương Hiệu",
                "name" => "thương hiệu",
                "key" => 'brands'
            ], [
                "title" => " Quản Lý Tin Tức",
                "name" => "tin tức",
                "key" => 'articles'
            ], [
                "title" => " Quản Lý Sản Phẩm",
                "name" => "sản phẩm",
                "key" => 'products'
            ], [
                "title" => "Quản Lý Khuyến Mãi",
                "name" => "khuyến mại",
                "key" => 'coupons'
            ], [
                "title" => " Quản Lý Tài Khoản",
                "name" => "tài khoản",
                "key" => 'users'
            ], [
                "title" => " Quản Lý Quyền Quản Trị",
                "name" => "quyền quản trị",
                "key" => 'roles'
            ], [
                "title" => "Quản lý Liên Hệ",
                "name" => "liên hệ",
                "key" => 'contact'
            ]
        ];
        $actions = [
            ['key' => 'view', 'name' => 'Danh sách'],
            ['key' => 'create', 'name' => 'Thêm'],
            ['key' => 'edit', 'name' => 'Sửa'],
            ['key' => 'delete', 'name' => 'Xóa'],
        ];

        foreach ($moduls as $modul) {

            $permission = Permission::updateOrCreate([
                'key_code' => Str::slug("moduls {$modul['key']}")
            ], [
                'name' =>  $modul['title'],
                'display_name' =>  $modul['title'],
                'key_code' => Str::slug("moduls {$modul['key']}"),
                'parent_id' => 0
            ]);

            foreach ($actions as $action) {
                $name = $action['name'] . " ".$modul['name'];
                $key = $action['key'] . " " . $modul['key'];

                Permission::updateOrCreate([
                    'key_code' => Str::slug($key)
                ], [
                    'name' => $name,
                    'display_name' => $name,
                    'key_code' => Str::slug($key),
                    'parent_id' => $permission->id
                ]);
            }
        }
        $permission_id = Permission::updateOrCreate([
            'key_code' => 'order-setting'
        ], [
            'name' => 'Quản Lý Hóa Đơn && Setting Website',
            'display_name' => 'Quản Lý Hóa Đơn && Setting Website',
            'parent_id' => '0',
            'key_code' => 'order-setting'
        ]);

        DB::table('permissions')->insert([
            [
                'name' => 'Danh sách hóa đơn ',
                'display_name' => 'Danh sách hóa đơn',
                'parent_id' => $permission_id->id,
                'key_code' => 'view-orders'
            ],
            [
                'name' => 'Sửa hóa đơn',
                'display_name' => 'Sửa hóa đơn',
                'parent_id' => $permission_id->id,
                'key_code' => 'edit-orders'
            ],
            [
                'name' => 'Xóa hóa đơn',
                'display_name' => 'Xóa hóa đơn',
                'parent_id' => $permission_id->id,
                'key_code' => 'delete-orders'
            ],
            [
                'name' => 'Setting Website',
                'display_name' => 'Setting Website',
                'parent_id' => $permission_id->id,
                'key_code' => 'setting-website'
            ]
        ]);
    }
}
