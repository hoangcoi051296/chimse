@extends('manager.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sửa người giúp việc</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{route('manager.employee.update',['id'=>$helper->id])}}" method="post" >
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Tên </label>
                                    <input type="text" name="name" value="{{$helper->name}}" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input name="email" type="email" value="{{$helper->email}}"  class="form-control"  disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Số điện thoại</label>
                                    <input name="phone" value="{{$helper->phone}}" type="text"   class="form-control" >
                                </div>
                                <div class="form-group">
                                    @if($helper->district_id)
                                        <input id="districtPost" value="{{$helper->ward->district->maqh}}" hidden>
                                    @endif
                                    <label for="inputStatus">Quận huyện</label>
                                    <select  class="form-control custom-select" name="district">
                                        <option selected="" disabled="">Hà Nội </option>
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}"}} @if($helper->district_id){{$helper->district_id==$a->maqh?"selected='selected'":''}} @endif >{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    @if($helper->ward_id)
                                        <input id="wardPost" value="{{$helper->ward->xaid}}"  hidden>
                                    @endif
                                    <label for="inputStatus">Xã phường</label>
                                    <select  class="form-control custom-select" name="ward" id="ward">
                                    </select>
                                </div>
                                <div>
                                    <input class="form-group" type="checkbox" name="changepass" id="checkbox" value="1"> <span>Thay đổi mật khẩu</span>
                                </div>
                                <div id="password" style="display: none">
                                    <div class="form-group">
                                        <label for="inputPassword">Mật khẩu </label>
                                        <input type="password" name="password" id="inputClientCompany" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProjectLeader">Nhập lại mật khẩu</label>
                                        <input type="password" name="password_confirmation" id="inputProjectLeader" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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
                <div class="row " style="margin-bottom: 40px" >
                    <div class="col-12">

                        <button type="submit"  class="btn btn-success float-left"> Cập nhật</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script src="{{asset("js/getAddress.js")}}"></script>
    <script>
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
@endsection
