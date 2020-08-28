<?php
use App\Models\Post;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
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
if (!function_exists("employeeStatus")) {
    function employeeStatus()
    {
        return $status =[
            [
                'value' => 0,
                'name' => 'Chờ việc'
            ],
            [
                'value' => 1,
                'name' => 'Chờ xác nhận'
            ],
            [
                'value' => 2,
                'name' => 'Xác nhận CV'
            ],
            [
                'value' => 3,
                'name' => 'Bắt đầu'
            ],
            [
                'value' => 4,
                'name' => 'Hoàn thành CV'
            ],
        ];
    }
}if (!function_exists("statusEmployee")) {
    function statusEmployee($status_id)
    {
        if ($status_id==Employee::ChoViec){
            $status='Chờ việc';
            }
        elseif ($status_id==Employee::ChoXacNhan){
            $status='Chờ xác nhận';
        }elseif ($status_id==Employee::XacNhanCV){
            $status='Xác nhận công việc';
        }elseif ($status_id==Employee::BatDau){
            $status='Bắt đầu';
        }elseif ($status_id==Employee::HoanThanh){
            $status='Kết thúc';
        }
        return $status;
    }
}
if (!function_exists("employeePostStatus")) {
    function employeePostStatus()
    {
        return $status =[
            [
                'value' => 3,
                'name' => 'Chờ xác nhận'
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
                'name' => 'Người thuê xác nhận hoàn thành'
            ],
            [
                'value' => 0,
                'name' => 'Đã huỷ'
            ],
        ];
    }
}
if (!function_exists("employeeGetStatus")) {
    function employeeGetStatus($status_id)
    {
        if ($status_id==Post::DaHuy){
            $status='Đã huỷ';
        }elseif ($status_id==Post::TimDuocNGV){
            $status='Chờ xác nhận';
        }elseif ($status_id==Post::NGVXacNhanCV){
            $status='Xác nhận công việc';
        }elseif ($status_id==Post::NGVBatDau){
            $status='Bắt đầu';
        }elseif ($status_id==Post::NGVKetThuc){
            $status='Kết thúc';
        }
        else ($status_id==Post::NTXacNhan){
        $status='Người thuê xác nhận hoàn thành'
        };
        return $status;
    }
}

if (!function_exists("managerPostStatus")) {
    function managerPostStatus()
    {
        return $status =[
            [
                'value' => 1,
                'name' => 'Chờ Duyệt'
            ],
            [
                'value' => 2,
                'name' => 'Duyệt Bài'
            ],
            [
                'value' => 3,
                'name' => 'Tìm được NGV'
            ],
        ];
    }
}

if (!function_exists("getAttributes")) {
    function getValueAttribute($key)
    {
        $attribute =Attribute::find($key);
        return $attribute;
    }
}
if (!function_exists("avgRate")) {
    function avgRate($employee)
    {
       $a =DB::table('feedback')->where('employee_id',$employee->id)->get();
        $avgRate =  $a->avg('rating');
         if ($avgRate==null){
             return "Chưa có đánh giá";
         }
         return  $avgRate.'/'.'5'.'( '.$a->count().' đánh giá ) ';
    }
}
