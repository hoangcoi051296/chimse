@extends('customer.layout.layout')
<style>
    .errorCustom {
        margin-left: 5px;
        font-style: italic;
        color: firebrick;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách công việc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('customer.logout')}}">Đăng xuất</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>{{Session::get('success')}}</strong>
                    </div>
                @endif
                <div class="col-md-12">
                    <form action="{{route('customer.post.index')}}" method="GET">
                        <div class="row">
                            <div class="col-md-2 ">
                                <select class="form-control" name="status">
                                    <option {{Request::get('status')==null ?"selected='selected'":'' }} value="">Trạng
                                        thái
                                    </option>
                                    @foreach(listPostStatus() as $status)
                                        <option {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="district">
                                    <option value="">District</option>
                                    @foreach($address as $a)
                                        <option {{Request::get('address')==$a->maqh ?"selected='selected'":''}}
                                                value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-control" name="ward">
                                    <option value="">Ward</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="startTime">
                            </div>
                            <div class="col-md-2">
                                <input type="date" class="form-control" name="finishTime">
                            </div>
                            <div class="col-md-2">
                                <div class="input-group input-group-sm">
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" placeholder="Search" aria-label="Search"
                                               name="search"
                                               id="search" style="height: 37px">
                                        <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-12" style="text-align: end; margin-top: 15px;">
                    <a href="{{route('customer.post.create')}}" class="btn btn-success" style="margin-top: -10px">Tạo
                        Bài Đăng</a>
                </div>
            </div>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-xs">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Tên</th>
                                {{--<th>Mô tả</th>--}}
                                <th>Giá</th>
                                <th class="customer-address">Địa chỉ</th>
                                <th class="customer-status">Trạng thái</th>
                                <th class="customer-time">Thời gian</th>
                                <th class="customer-category">Danh mục</th>
                                <th class="customer">Người giúp việc</th>
                                <th>Đánh giá</th>
                                <th style="width: 113px">Hoạt động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $key => $post)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{ $post->title}}</td>
                                    <td>${{ number_format($post->price)}}</td>
                                    <td>
                                        @if($post->ward_id)
                                            {{$post->ward->name}}
                                        @endif
                                        @if($post->district_id),
                                        {{$post->ward->district->name}}
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row postStatus" data-value="{{$post->id}}">
                                            {{getPostStatus($post->status)}}</div>
                                    </td>
                                    <td>{{$post->time_start ." " .$post->time_end}}</td>
                                    <td>@if($post->category)
                                            {{$post->category->name}}
                                        @endif</td>
                                    <td>
                                        @if($post->employee)
                                            {{$post->employee->name }}
                                        @else
                                        @endif
                                    </td>
                                    <td style="width: 13%;">
                                    <span id="number_rating" data-value="{{$post->rating->avg('rating')}}">
                                    @for($i=1;$i<=5;$i++)
                                            @if($i<=$post->rating->avg('rating') && $post->status == 7)
                                                <i class="fa fa-star" style="color: #FFCC00;">
                                        </i>
                                            @else
                                                <i class="fa fa-star"></i>
                                            @endif
                                        @endfor
                                    </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.post.edit',['id' => $post->id])}}"
                                           class="btn btn-primary btn-xs @if(in_array($post->status,[3,4,5,6,7])) hide @endif"><i
                                                    class="fa fa-edit"></i></a>
                                        <a href="{{ route('customer.post.delete',['id'=> $post->id])}}"
                                           onclick="return confirm('Bạn muốn xóa không?');"
                                           class="btn btn-danger btn-xs @if(in_array($post->status,[3,4,5,6,7])) hide @endif"><i
                                                    class="fa fa-trash"></i></a>
                                        @if($post->status==6)
                                            <form action="{{route('customer.post.changeStatus',['id'=>$post->id])}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-info"><i class="fas fa-exchange-alt"></i></button>
                                            </form>
                                        @endif

                                        @if($post->status== 7)
                                            <a href="{{\Illuminate\Support\Facades\URL::signedRoute('customer.post.complete',['id'=>$post->id])}}"
                                               class="btn btn-primary btn-xs "><i class="far fa-check-circle"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{$posts->appends(request()->query())->links()}}
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>

        <!-- /.container-fluid -->
    </section>
    <style>
        .hide {
            display: none;
        }
    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script>
        // $(function () {
        //     $('input[name="time"]').daterangepicker({
        //         autoUpdateInput: true,
        //         timePicker: true,
        //         startDate: moment().startOf('hour'),
        //         endDate: moment().startOf('hour').add(32, 'hour'),
        //         locale: {
        //             format: 'YYYY-MM-DD HH:mm '
        //         }
        //     });
        //     $('input[name="time"]').val('');
        // });
        $(function () {

            $('input[name="time"]').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="time"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });

            $('input[name="time"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });

        });

        var url = "{{ url('customer/post/showWard') }}";
        $("select[name='district']").change(function () {
            var address = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    address: address,
                    _token: token,
                },
                success: function (data) {
                    $("select[name='ward']").html('');
                    $.each(data, function (key, value) {
                        console.log(value)
                        $("select[name='ward']").html("<option value=''>Ward</option>")
                        ;
                        $("select[name='ward']").append(
                            "<option value=" + value.xaid + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
    </script>

@endsection
                   
