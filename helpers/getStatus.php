<?php
use App\Models\Post;
/**
 * Created by PhpStorm.
 * User: Duc Thang
 * Date: 8/4/2020
 * Time: 9:53 PM
 */
if (!function_exists("getStatus")) {
    function getStatus($status_id)
    {
        if ($status_id==Post::DaHuy){
            $status='Đã huỷ';
        }elseif ($status_id==Post::ChoDuyet){
            $status='Chờ duyệt';
        }elseif ($status_id==Post::DaDuyet){
            $status='Đã duyệt';
        }elseif ($status_id==Post::TimDuocNGV){
            $status='Tìm được người giúp việc';
        }elseif ($status_id==Post::NGVXacNhanCV){
            $status='Người giúp việc xác nhận công việc';
        }elseif ($status_id==Post::NGVBatDau){
            $status='Người giúp việc bắt đầu';
        }elseif ($status_id==Post::NGVKetThuc){
            $status='Người giúp việc kết thúc';
        }
        else ($status_id==Post::NTXacNhan){
            $status='Người thuê xác nhận hoàn thành'
        };
      return $status;
    }
}
if (!function_exists("listStatus")) {
    function listStatus()
    {
        return $status =[
            [
                'value' => 1,
                'name' => 'Chờ Duyệt'
            ],
            [
                'value' => 2,
                'name' => 'Đã Duyệt'
            ],
            [
                'value' => 3,
                'name' => 'Tìm được NGV'
            ],
            [
                'value' => 4,
                'name' => 'Xác nhận CV'
            ],
            [
                'value' => 5,
                'name' => 'Bắt đầu'
            ],
            [
                'value' => 6,
                'name' => 'Hoàn thành CV'
            ],
            [
                'value' => 7,
                'name' => 'Kết thúc CV'
            ],
            [
                'value' => 0,
                'name' => 'Hủy'
            ]
        ];
    }
}
