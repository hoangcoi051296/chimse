<?php
//$listStatus = listStatus();
?>
@extends('manager.layout.layout')
<style>
    .filterData{
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
                            <div class="form-group filterData ">
                                <select  class="form-control" name="status">
                                    <option {{Request::get('status')==null ?"selected='selected'":'' }} value="" >Trạng thái</option>
                                    @foreach(listStatus() as $status)
                                        <option {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group filterData">
                                <select class="form-control" name="address">
                                    <option value="">Địa chỉ</option>
                                    @foreach($address as $a)
                                        <option {{Request::get('address')==$a->maqh ?"selected='selected'":''}}  value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text" class="form-control" name="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.post.index')}}"  class="btn btn-secondary btn-flat"><i class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a  href="{{route('manager.post.create')}}" class="btn btn-success float-right " style="margin-bottom: 10px">Tạo bài đăng</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th style="width: 35%">Description</th>
                                    <th><a>Price</a></th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Category</th>
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
                                                {{$post->description}}
                                            </td>
                                            <td>{{$post->price}}</td>
                                            @if($post->address)
                                                <td>{{$post->findDistrict(json_decode($post->address,true)['district'])->name}},
                                                    {{$post->findWard(json_decode($post->address,true)['ward'])->name}}
                                                </td>
                                            @else
                                                <td>null</td>
                                            @endif
                                            <td>
                                                <div class="row postStatus" data-value="{{$post->id}}" >
                                                    {{getStatus($post->status)}}</div>
                                            </td>
                                            <td>{{$post->customer->name}}</td>
                                            <td>{{$post->category->name}}</td>
                                            <td class="align-self-center" >
                                                <a href="{{ route('manager.post.details',['id' => $post->id])}}"
                                                   class="btn btn-info btn-xs"><i class="far fa-eye"></i></a>
                                                @if($post->status==1)
                                                    <a id="{{$post->id}}"
                                                       class="btn btn-primary btn-xs changeStatus"><i class="fas fa-exchange-alt"></i></a>
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
