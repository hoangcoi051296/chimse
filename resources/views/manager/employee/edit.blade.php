@extends('manager.layout.layout')
@section('style')
    <style>
        .errorCustom {
            margin-left: 10px;
            font-style: italic;
            color: firebrick;
        }
    </style>
@endsection
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
                                    <input type="text" name="name" value="{{$helper->name}}" id="inputName" class="form-control @if($errors->has('name'))  border border-info @endif">
                                    @if($errors->has('name'))
                                        <span class="errorCustom">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input name="email" type="email" value="{{$helper->email}}"  class="form-control @if($errors->has('email'))  border border-info @endif"  disabled>
                                    @if($errors->has('email'))
                                        <span class="errorCustom">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Số điện thoại</label>
                                    <input name="phone" value="{{$helper->phone}}" type="text"   class="form-control @if($errors->has('phone'))  border border-info @endif" >
                                    @if($errors->has('phone'))
                                        <span class="errorCustom">{{$errors->first('phone')}}</span>
                                    @endif
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
                                        @if($errors->has('district'))
                                            <span class="errorCustom">{{$errors->first('district')}}</span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    @if($helper->ward_id)
                                        <input id="wardPost" value="{{$helper->ward->xaid}}"  hidden>
                                    @endif
                                    <label for="inputStatus">Xã phường</label>
                                    <select  class="form-control custom-select" name="ward" id="ward">
                                    </select>
                                        @if($errors->has('ward'))
                                            <span class="errorCustom">{{$errors->first('ward')}}</span>
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
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
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
