@extends('manager.layout.layout')

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
                           @if($manager->avatar)
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset($manager->avatar)}}"  id="output" alt="User profile picture">
                                </div>
                            @else
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset("images/avt.jpeg")}}"  id="output" alt="User profile picture">
                                </div>
                            @endif

                            <h3 class="profile-username text-center">{{$manager->name}}</h3>

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
                                        <form class="form-horizontal" style="height: 325px" method="post" action="{{route('manager.account.update',['id'=>$manager->id])}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Tên</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" value="{{$manager->name}}" class="form-control" id="inputName">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input disabled type="email" name="email" class="form-control" id="inputEmail" value="{{$manager->email}}">
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
    </script>
    @endsection
