@extends('employee.layout.layout')
<link href="{{asset('js/bootstrap-rating.css')}}" rel="stylesheet">
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách đánh giá</h1>
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form class=" ml-3" >
                        <div class="card">
                            <div class="input-group input-group-lg">
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
                                <tr>
                                    <th style="width: 10px">#Bài đăng</th>
                                    <th>Người thuê</th>
                                    <th>Đánh giá</th>
                                    <th>Rating</th>
                                    <th >Ngày tạo</th>
                                    <th >Ngày cập nhật</th>
                                </tr>
                                <tbody>
                                @foreach($employee->customer as $customer)
                                    <tr>
                                        <td>{{$customer->pivot->post_id}}</td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->pivot->comment}}</td>
                                        <td>
                                            @if($customer->pivot->rating==1)
                                            <i class="fas fa-star" style="color: yellowgreen"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>

                                            @elseif($customer->pivot->rating==2)
                                            <i class="fas fa-star" style="color: yellowgreen"></i>
                                            <i class="fas fa-star" style="color: yellowgreen"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            @elseif($customer->pivot->rating==3)
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>

                                            @elseif($customer->pivot->rating==4)
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star"></i>

                                                @else
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                                <i class="fas fa-star" style="color: yellowgreen"></i>
                                            @endif

                                        <td>{{$customer->pivot->created_at}}</td>
                                        <td>{{$customer->pivot->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/bootstrap-rating.js')}}"></script>
@endsection
