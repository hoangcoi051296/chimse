@extends('manager.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách người thuê</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('manager.customer.index')}}"><i
                                        class="zmdi zmdi-power"></i>Danh sách</a>
                        </li>
                    </ol>
                </div>
                <div class="col-md-12" style="text-align: end; margin-top: 15px;">
                    <a href="{{route('manager.customer.create')}}" class="btn btn-success">Tạo Người Thuê</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

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

                    <form class=" ml-3">
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                       aria-label="Search" name="search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
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
                                    <th style="width: 10px">Id</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 113px">Hoạt động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $key => $customer)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{ $customer->name}}</td>
                                        <td>
                                            {{$customer->email}}
                                        </td>
                                        <td>{{$customer->phone}}</td>
                                        <td>{{$customer->ward?$customer->ward->name:''}}
                                            {{$customer->ward ? ($customer->ward->district?$customer->ward->district->name:''):''}}
                                        </td>
                                        <td>
                                            <a href="{{ route('manager.customer.edit',['id' => $customer->id])}}"
                                               class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('manager.customer.delete',['id'=> $customer->id])}}"
                                               onclick="return confirm('Bạn muốn xóa không?');"
                                               class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>
                                            <a href="{{route('manager.customer.post.index',['id' => $customer->id])}}"
                                               class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$customers->links()}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
