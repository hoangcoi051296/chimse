<?php
//$listStatus = listStatus();
?>
@extends('employee.layout.layout')
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
                </div><!-- /.col --><!-- /.col -->
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
                                        <option
                                            {{Request::get('district')==$a->maqh?"selected='selected":''}} value="{{$a->maqh}}">{{$a->name}}</option>
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
                                    @foreach(employeePostStatus() as $status)
                                        <option
                                            {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
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
                                     <a href="{{route('employee.post.index')}}" class="btn btn-secondary btn-flat"><i
                                             class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
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
                                    <th>Người thuê</th>
                                    <th>Địa chỉ</th>
                                    <th>Thời gian</th>
                                    <th>Trạng thái</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th style="width: 8%">Chi tiết</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <form>
                                            @csrf
                                            <td>{{ $post->title}}</td>
                                            <td>{{$post->customer->name}}</td>
                                            <td> @if($post->ward_id)
                                                    {{$post->ward->name}}
                                                @endif
                                                @if($post->district_id),
                                                {{$post->ward->district->name}}
                                                @endif</td>
                                            <td>
                                                @if($post->time)
                                                    {{$post->time}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row postStatus" data-value="{{$post->id}}">
                                                    {{employeeGetStatus($post->status)}}</div>
                                            </td>
                                            <td>{{$post->price}}</td>
                                            <td>{{$post->category->name}}</td>
                                            <td class="align-self-center">
                                                <a href="{{ route('employee.post.details',['id' => $post->id])}}"
                                                   class="btn btn-info btn-xs"><i class="far fa-eye"></i></a>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{--                            {{$posts->appends(request()->query())->links()}}--}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('script')
    <script src="{{asset("js/getAddress.js")}}"></script>
@endsection
