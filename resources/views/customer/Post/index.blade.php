<?php
$listStatus = listStatus();
?>
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
                        <li class="breadcrumb-item"><a href="{{route('customer.post.index')}}">Danh sách</a></li>
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
                            <div class="col-md-2">
                                <select class="form-control" name="status">
                                    <option {{Request::get('status')==null ?"selected='selected'":'' }} value="">Trạng
                                        thái
                                    </option>
                                    @foreach(listStatus() as $status)
                                        <option
                                                {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}
                                                value="{{$status['value']}}">{{$status['name']}}</option>
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
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group-append" data-target="#timepicker"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        <input type="text" name="time" class="form-control datetimepicker-input"
                                               data-target="#timepicker" id="timepicker">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                <input class="form-control" placeholder="Search" aria-label="Search" name="search"
                                       id="search">
                                <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-12" style="text-align: end; margin-top: 15px;">
                    <a href="{{route('customer.post.create')}}" class="btn btn-success">Tạo Bài Đăng</a>
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
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th class="customer-address">Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Thời gian</th>
                            <th>Danh mục</th>
                            <th>Khách hàng</th>
                            <th>Đánh giá</th>
                            <th style="width: 113px">Hoạt động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $key => $post)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{ $post->title}}</td>
                                <td>
                                    {!! $post->description!!}
                                </td>
                                <td>{{$post->price}}$</td>
                                <td>
                                    @if($post->ward_id)
                                        {{$post->ward->name}}
                                    @endif
                                    @if($post->district_id),
                                    {{$post->ward->district->name}}
                                    @endif
                                </td>
                                <td>
                                    @foreach($listStatus as $s)
                                        @if($post->status == $s['value'])
                                            {{$s['name']}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$post->time}}</td>
                                <td>@if($post->category)
                                        {{$post->category->name}}
                                    @endif</td>
                                <td>{{$post->customer->name }}</td>
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
                                       class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="{{ route('customer.post.delete',['id'=> $post->id])}}"
                                       onclick="return confirm('Bạn muốn xóa không?');"
                                       class="btn btn-danger btn-xs"><i
                                                class="fa fa-trash"></i></a>
                                        <a id="{{route('customer.post.changeStatus')}}"
                                           class="btn btn-primary btn-xs changeStatus"><i
                                                    class="fas fa-exchange-alt"></i></a>
                                       @if($post->status==\App\Models\Post::NGVKetThuc)
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
        </div><!-- /.container-fluid -->
    </section>
    <script>
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
                    console.log(data)
                    $("select[name='ward']").html('');
                    $.each(data, function (key, value) {
                        console.log(value)
                        $("select[name='ward']").html("<option value="
                        ">Ward</option>"
                    )
                        ;
                        $("select[name='ward']").append(
                            "<option value=" + value.xaid + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
        var urlStatus = "{{ url('customer/post/changeStatus') }}";
        $(".changeStatus").click(function () {
            var id = this.id;
            var token = $("input[name='_token']").val();
            $.ajax({
                url: urlStatus,
                method: 'POST',
                data: {
                    id: id,
                    _token: token,
                },
                success: function (data) {
                    location.reload();
                }
            });
        });
    </script>

@endsection
                   
