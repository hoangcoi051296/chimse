@extends('manager.layout.layout')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<style type="text/css">
    .fc-popover{
        width: 400px;
    }
    .fc-more-popover{
        width: 400px;
    }
</style>
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thông tin người giúp việc</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Thông tin người giúp việc</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <h3 class="profile-username text-center">{{$employee->name}}</h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Số đơn hoàn thành</b> <a class="float-right">{{count($post)}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Đánh giá trung bình</b> <a class="float-right">{{$employee->avgRate}}</a>
                                </li>
                                <?php $now=\Carbon\Carbon::now();
                                        $year=$now->year;
                                    $month =$now->month;
                                    $postInmonth=\App\Models\Post::where('employee_id',$employee->id)
                                ?>
                                <li class="list-group-item">
                                    <b>Tổng thu nhập trong tháng ({{$year}}-{{$month}}-1 đến {{date_format($now,'Y-m-d')}} )</b> <a class="float-right">$ {{incomeEmployeeInMonth($employee->id)}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Tổng thu nhập</b> <a class="float-right">$ {{$post->sum('price')}}</a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Lịch làm việc</a></li>
                                <li class="nav-item"><a class="nav-link" href="#success" data-toggle="tab">Đơn hàng hoàn thành</a></li>
                                <li class="nav-item"><a class="nav-link" href="#cancel" data-toggle="tab">Đơn hàng đã huỷ</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="timeline">
                                    {!! $calendar->calendar() !!}
                                    {!! $calendar->script() !!}
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="success">
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="cancel">

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('script')

    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

@endsection
