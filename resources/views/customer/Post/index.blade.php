<?php
$listStatus = listStatus();
?>
@extends('customer.layout.layout')
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
                        <div class="rs-select2--light rs-select2--sm" style="width: 175px !important;">
                            <select class="js-select2" name="province" id="province">
                                <option selected="selected" value="">Chọn tỉnh</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->matp}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                            <select class="js-select2" name="district" id="district">
                                <option selected="selected" value="">Chọn huyện</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-success">Go!</button>
                            <div class="dropDownSelect2"></div>
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
                                    <th>Category</th>
                                    <th>Customer</th>
                                    <th>Review</th>
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
                                        <td>{{$post->full_address}}</td>
                                        <td>
                                            @foreach($listStatus as $s)
                                                @if($post->status == $s['id'])
                                                    {{$s['name']}}
                                                @endif
                                            @endforeach
                                        </td>

                                        <td>{{$post->category->name}}</td>
                                        <td>{{$post->customer->name}}</td>
                                        <td  style="width: 13%;">
                                            @for($i=1;$i<=$post->rating->avg('rating');$i++)
                                                <i class="fa fa-star">
                                                    @endfor
                                                </i></td>
                                        <td>
                                            <a href="{{ route('customer.post.edit',['id' => $post->id])}}"
                                               class="btn btn-primary btn-xsmax"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('customer.post.delete',['id'=> $post->id])}}"
                                               onclick="return confirm('Bạn muốn xóa không?');"
                                               class="btn btn-danger btn-xsmax"><i
                                                        class="fa fa-trash"></i></a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$posts->links()}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <script>
        $('#province').change(() => {
            $('#commune').html('');
            let province_id = $('#province').val();
            $.ajax({
                url: "{{ route('district.by.province') }}",
                type: "GET",
                data: {id: province_id},
                success: function (response) {
                    if (!response.errors) {
                        let list_district;
                        response.data.forEach(district => {
                            list_district += `<option value="${district.maqh}">${district.name}</option>`;
                        });
                        $('#district').html(list_district);
                    }
                }
            });
        })
    </script>
@endsection
                   