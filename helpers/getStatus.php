<?php
use App\Models\Post;
use App\Models\Attribute;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\District;
/**
 * Created by PhpStorm.
 * User: Duc Thang
 * Date: 8/4/2020
 * Time: 9:53 PM
 */
if (!function_exists("getPostStatus")) {
    function getPostStatus($status_id)
    {
        if (isset($status_id)){
            if ($status_id==0){
                $status='Đã huỷ';
            }elseif ($status_id==1){
                $status='Chờ duyệt';
            }elseif ($status_id==2){
                $status='Đã duyệt';
            }elseif ($status_id==3){
                $status='Tìm được người giúp việc';
            }elseif ($status_id==4){
                $status='Người giúp việc xác nhận công việc';
            }elseif ($status_id==5){
                $status='Người giúp việc bắt đầu';
            }elseif ($status_id==6){
                $status='Người giúp việc kết thúc';
            }
            elseif ($status_id==7){
                    $status='Người thuê xác nhận hoàn thành';
            };
            return $status ;
        }
        return false;
    }
}
if (!function_exists("listPostStatus")) {
    function listPostStatus()
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
if (!function_exists("listManagerStatus")) {
    function listManagerStatus()
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
        ];
    }
}
if (!function_exists("employeeStatus")) {
    function listEmployeeStatus()
    {
        return $status =[
            [
                'value' => 0,
                'name' => 'Chưa có việc'
            ],
            [
                'value' => 1,
                'name' => 'Có việc'
            ]
        ];
    }
}
if (!function_exists("getEmployeeStatus")) {
    function statusEmployee($status_id)
    {
        if ($status_id==0){
            $status='Chưa có việc';
            }
        elseif ($status_id==1) {
            $status = 'Có việc';
        }
        return $status;
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


if (!function_exists("wardSeed")) {
    function wardSeed($district)
    {
        $wards = Ward::Where('maqh',$district)->pluck('xaid')->toArray();
        $ward=array_rand(array_flip($wards));
        return  $ward;
    }
}
if (!function_exists("getWard")) {
    function districtSeed()
    {
        $districts = District::where('matp', 01)->pluck('maqh')->toArray();
        $district=array_rand(array_flip($districts));
        return  $district;
    }
}
