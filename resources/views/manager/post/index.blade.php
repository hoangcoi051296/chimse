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
                    <h1 class="m-0 text-dark">Danh sách công việc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#"></a>Danh sách</li>
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

                        <div class="input-group input-group-sm">
                            <div class="form-group filterData">
                                @if(Request::get('district'))
                                    <input id="districtPost" value="{{Request::get('district')}}" hidden>
                                @endif
                                <select class="form-control" name="district">
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
                                    <option {{Request::get('status')==null ?"selected='selected'":'' }} value="">Trạng
                                        thái
                                    </option>
                                    @foreach(listStatus() as $status)
                                        <option {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text"
                                           class="form-control" name="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.post.index')}}" class="btn btn-secondary btn-flat"><i
                                                 class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a href="{{route('manager.post.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo bài đăng</a>
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
                                    <th>Khách hàng</th>
                                    <th>Danh mục</th>
                                    <th style="width: 8%">Action</th>
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
                                                    {{getStatus($post->status)}}</div>
                                            </td>
                                            <td>{{$post->customer->name}}</td>
                                            <td>@if($post->category)
                                                    {{$post->category->name}}
                                                @endif</td>
                                                {{--                                        @if($post->attributes)--}}

                                                {{--                                           @foreach( json_decode($post->attributes,true) as $key => $attribute )--}}
                                                {{--                                               <div class="row">--}}
                                                {{--                                                   <span>{{getAttributes($key)->name}}</span> : <p>{{json_decode(getAttributes($key)->options,true)[$attribute]}}</p>--}}
                                                {{--                                               </div>--}}
                                                {{--                                                @endforeach--}}
                                                {{--                                            @endif--}}
                                            </td>
                                            <td class="align-self-center">
                                                <a href="{{ route('manager.post.details',['id' => $post->id])}}"
                                                   class="btn btn-info btn-xs"><i class="far fa-eye"></i></a>
                                                @if($post->status==1)
                                                    <a id="{{$post->id}}"
                                                       class="btn btn-primary btn-xs changeStatus"><i
                                                                class="fas fa-exchange-alt"></i></a>
                                                @endif

                                                <a href="{{ route('manager.post.edit',['id' => $post->id])}}"
                                                   class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('manager.post.delete',['id'=> $post->id])}}"
                                                   onclick="return confirm('Bạn muốn xóa không?');"
                                                   class="btn btn-danger btn-xs "><i
                                                            class="fa fa-trash"></i></a>

                                            </td>
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
