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

            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <form class="" method="GET">
                <div class="row">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>{{Session::get('success')}}</strong>
                        </div>
                    @endif
                    <div class="col-md-12" style="text-align: end; margin-top: 15px;">
                        <a href="{{route('manager.customer.create')}}" class="btn btn-success">Tạo Người Thuê</a>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="district" id="district" style="margin-bottom: 20px">
                            <option value="">District</option>
                            @foreach($address as $a)
                                <option {{Request::get('address')==$a->maqh ?"selected='selected'":''}}
                                        value="{{$a->maqh}}">{{$a->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="ward" id="ward">
                            <option value="">Ward</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="price" id="price" style="margin-bottom: 20px">
                            <option value="">Price</option>
                            @foreach($customers1 as $key => $customer)
                                <option value="{{$customer->sum_money_paid}}">{{number_format ($customer->sum_money_paid)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm">
                            <div class="input-group input-group-sm">
                                <input class="form-control" placeholder="Search" aria-label="Search" name="search"
                                       id="search" style="height: 37px">
                                <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                            </div>
                        </div>
                    </div>
            </form>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Avatar</th>
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
                                    <td>
                                        @if($customer->avatar)
                                            <img class="img" src="{{$customer->avatar}}"
                                                 style="width: 50px;height: 50px">
                                        @else
                                            <img class="img" src="{{asset('images/avt.jpeg')}}"
                                                 style="width: 50px;height: 50px">
                                        @endif
                                    </td>
                                    <td>{{ $customer->name}}</td>
                                    <td>
                                        {{$customer->email}}
                                    </td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->ward?$customer->ward->name:''}}
                                        {{$customer->ward ? ($customer->ward->district?$customer->ward->district->name:''):''}}
                                    </td>
                                    <td>
                                        {{--<a href="{{ route('manager.customer.edit',['id' => $customer->id])}}"--}}
                                           {{--class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a>--}}
                                        {{--<a href="{{ route('manager.customer.delete',['id'=> $customer->id])}}"--}}
                                           {{--onclick="return confirm('Bạn muốn xóa không?');"--}}
                                           {{--class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></a>--}}
                                        <a href="{{route('manager.customer.post.index',['id' => $customer->id])}}"
                                           class="btn btn-success btn-xsmax"><i class="fa fa-eye"></i></a>
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
