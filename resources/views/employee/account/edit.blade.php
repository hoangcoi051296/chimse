@extends('employee.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manager</h1>
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
                            @if($employee->avatar)
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset($employee->avatar)}}"  id="output" alt="User profile picture">
                                </div>
                            @else
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset("images/avt.jpeg")}}"  id="output" alt="User profile picture">
                                </div>
                            @endif

                            <h3 class="profile-username text-center">{{$employee->name}}</h3>

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

                            <a href="#" id="changeAvatar" class="btn btn-primary btn-block"><b>Đổi ảnh đại diện</b></a>

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
                                        <form class="form-horizontal"  method="post" action="{{route('employee.account.update',['id'=>$employee->id])}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="inputName">Tên </label>
                                                <input type="text" name="name" value="{{$employee->name}}" id="inputName" class="form-control @if($errors->has('name'))  border border-info @endif">
                                                @if($errors->has('name'))
                                                    <span class="errorCustom">{{$errors->first('name')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Email</label>
                                                <input name="email" type="email" value="{{$employee->email}}"  class="form-control @if($errors->has('email'))  border border-info @endif"  disabled>
                                                @if($errors->has('email'))
                                                    <span class="errorCustom">{{$errors->first('email')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="inputEmail">Số điện thoại</label>
                                                <input name="phone" value="{{$employee->phone}}" type="text"   class="form-control @if($errors->has('phone'))  border border-info @endif" >
                                                @if($errors->has('phone'))
                                                    <span class="errorCustom">{{$errors->first('phone')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                @if($employee->district_id)
                                                    <input id="districtPost" value="{{$employee->ward->district->maqh}}" hidden>
                                                @endif
                                                <label for="inputStatus">Quận huyện</label>
                                                <select  class="form-control custom-select" name="district_id" id="district">
                                                    <option selected="" disabled="">Hà Nội </option>
                                                    @foreach($address as $a)
                                                        <option value="{{$a->maqh}}"}} @if($employee->district_id){{$employee->district_id==$a->maqh?"selected='selected'":''}} @endif >{{$a->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('district_id'))
                                                    <span class="errorCustom">{{$errors->first('district_id')}}</span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                @if($employee->ward_id)
                                                    <input id="wardPost" value="{{$employee->ward->xaid}}"  hidden>
                                                @endif
                                                <label for="inputStatus">Xã phường</label>
                                                <select  class="form-control custom-select" name="ward_id" id="ward">
                                                </select>
                                                @if($errors->has('ward_id'))
                                                    <span class="errorCustom">{{$errors->first('ward_id')}}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <input class="form-group" type="checkbox" name="changepass" id="checkbox" value="1"> <span>Thay đổi mật khẩu</span>
                                            </div>
                                            <div id="password" style="display: none">
                                                <div class="form-group">
                                                    <label for="inputPassword">Mật khẩu </label>
                                                    <input type="password" name="password" id="inputClientCompany" class="form-control @if($errors->has('phone'))  border border-info @endif">
                                                    @if($errors->has('password'))
                                                        <span class="errorCustom">{{$errors->first('password')}}</span>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputProjectLeader">Nhập lại mật khẩu</label>
                                                    <input type="password" name="password_confirmation" id="inputProjectLeader" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group" hidden>
                                                <label>Image:</label>
                                                <input id="upload" type="file" name="image" onchange="loadFile(event)" class="form-control" >
                                            </div>
                                            <div class="form-group row">
                                                <div class="offset-sm-2 col-sm-10">
                                                    <button type="submit" class="btn btn-success">Cập nhật</button>
                                                </div>
                                            </div>
                                        </form>
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
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $('#changeAvatar').click(function (){
            $('#upload').click();
        });

        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $('body').on('change', '#checkbox', function(event) {
            event.preventDefault();
            var r = document.getElementById('checkbox').checked;
            if(r==true){
                document.getElementById('password').style.display = 'inline';
            }else{
                document.getElementById('password').style.display = 'none';
            }
        });
    </script>

    <script src="{{asset('js/getAddress.js')}}"></script>
@endsection
