<?php
$listStatus = listStatus();
?>
@extends('manager.layout.layout')
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
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/')}}"></a>Danh sách</li>
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

                    <form class="ml-3" action="{{route('customer.post.index')}}" method="GET">
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" placeholder="Search" aria-label="Search"
                                       name="search" id="search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" id="searchPost" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a href="{{route('customer.post.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo
                        bài đăng</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th style="width: 113px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{ $post->title}}</td>
                                        <td>
                                            {{$post->description}}
                                        </td>
                                        <td>{{$post->price}}</td>
                                        <td>{{$post->getAddress->name}}</td>
                                        <td>
                                            @foreach($listStatus as $s)
                                                @if($post->status == $s['id'])
                                                    {{$s['name']}}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$post->customer->name}}</td>
                                        <td>{{$post->category->name}}</td>
                                        {{--<td>--}}
                                            {{--<a href="{{ route('customer.post.edit',['id' => $post->id])}}"--}}
                                               {{--class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>--}}
                                            {{--<a href="{{ route('customer.post.delete',['id'=> $post->id])}}"--}}
                                               {{--onclick="return confirm('Bạn muốn xóa không?');"--}}
                                               {{--class="btn btn-danger btn-xs"><i--}}
                                                        {{--class="fa fa-trash"></i></a>--}}
                                        {{--</td>--}}
                                        
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{--<div class="card-footer clearfix">--}}
                            {{--{{$posts->links()}}--}}
                        {{--</div>--}}
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(()=>{
            $('#searchPost').click(() => {
                console.log("ok");
                $.ajax({
                    url: "{{ route('customer.post.index')}}",
    method: 'get',
    data: $('#search').val(),
    success: function(response){
    console.log(response);
    }});
    });
    });
    </script> --}}
@endsection
