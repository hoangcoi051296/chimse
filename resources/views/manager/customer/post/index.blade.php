<?php
//$listStatus = listStatus();
?>
@extends('manager.layout.layout')
<style>
    .filterData {
        margin-right: 20px;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách bài đăng của {{$customer->name}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('manager.customer.index')}}">Danh sách</a>
                        </li>
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
                <div class="col-md-12">
                    <form class=" ml-3">
                        <div class="row">
                            <div class="input-group input-group-sm">
                                <div class="form-group filterData">
                                    @if(Request::get('district'))
                                        <input id="districtPost" value="{{Request::get('district')}}" hidden>
                                    @endif
                                    <select class="form-control" name="district" id="district">
                                        <option value="">Quận huyện</option>
                                        @foreach($address as $a)
                                            <option {{Request::get('district')==$a->maqh?"selected='selected":''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group filterData" style="width: 200px">
                                    @if(Request::get('ward'))
                                        <input id="wardPost" value="{{Request::get('ward')}}" hidden>
                                    @endif
                                    <select class="form-control" name="ward" id="ward">
                                        <option selected="selected" value="">Xã phường</option>
                                    </select>
                                </div>
                                <div class="form-group filterData ">
                                    <select class="form-control" name="status">
                                        <option {{Request::get('status')==null ?"selected='selected'":'' }} value="">
                                            Trạng
                                            thái
                                        </option>
                                        @foreach(listPostStatus() as $status)
                                            <option {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
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
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Danh mục</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <form>
                                            @csrf
                                            <td>{{ $post->title}}</td>
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
                                            <td>@if($post->category)
                                                    {{$post->category->name}}
                                                @endif</td>
                                        </form>
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
@endsection
@section('script')
    <script type="text/javascript">
        var urlStatus = "{{ url('manager/post/changeStatus') }}";
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
    <script src="{{asset("js/getAddress.js")}}"></script>

@endsection
