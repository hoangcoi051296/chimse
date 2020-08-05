<?php
/**
 * Created by PhpStorm.
 * User: Duc Thang
 * Date: 8/4/2020
 * Time: 9:53 PM
 */
if (!function_exists("listStatus")) {
    function listStatus()
    {
        return [
            [
                'id' => 1,
                'name' => 'Chờ Duyệt'
            ],
            [
                'id' => 2,
                'name' => 'Đã Duyệt'
            ],
            [
                'id' => 3,
                'name' => 'Tìm được NGV'
            ],
            [
                'id' => 4,
                'name' => 'Xác nhận CV'
            ],
            [
                'id' => 5,
                'name' => 'Bắt đầu'
            ],
            [
                'id' => 6,
                'name' => 'Hoàn thành CV'
            ],
            [
                'id' => 7,
                'name' => 'Kết thúc CV'
            ],
            [
                'id' => 8,
                'name' => 'Hủy'
            ]
        ];
    }
}