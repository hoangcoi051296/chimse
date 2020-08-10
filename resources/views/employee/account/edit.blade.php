@extends('employee.layout.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset("images/avt.jpeg")}}" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{$user->name}}</h3>

                                <p class="text-muted text-center">Software Engineer</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Followers</b> <a class="float-right">1,322</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-primary btn-block"><b>Đổi ảnh đại diện</b></a>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="btn  btn-primary" href="#settings" data-toggle="tab">Thông tin tài khoản</a></li>
                                    @if(Session::has("success"))
                                            <li class="nav-item"><a class="btn  btn-success"  data-toggle="tab">{{Session('success')}}</a></li>
                                    @endif
                                </ul>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">
                                        <form class="form-horizontal" style="height: 325px" method="post" action="{{route('employee.account.update',['id'=>$user->id])}}">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" id="inputName">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" name="email" class="form-control" id="inputEmail" value="{{$user->email}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Địa chỉ</label>
                                                <select class="form-control custom-select col-sm-10" name="address">
                                                    <option selected="" disabled="">Địa chỉ </option>
                                                    @foreach($address as $a)
                                                        <option value="{{$a->maqh}}"}} {{$user->address==$a->maqh?"selected='selected'":''}} >{{$a->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputSkills" class="col-sm-2 col-form-label">Số điện thoại</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="phone" class="form-control" id="inputSkills" value="{{$user->phone}}">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="float: right">Thay đổi mật khẩu</button>
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p>Mật khẩu mới</p>
                                                            <input type="password" name="password" id="inputClientCompany" class="form-control">
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Nhập lại mật khẩu</p>
                                                            <input type="password" name="password_confirmation" id="inputClientCompany" class="form-control">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                There were some errors with your request.
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection
