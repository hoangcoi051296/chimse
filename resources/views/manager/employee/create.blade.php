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
                    <h1 class="m-0 text-dark">Tạo người giúp việc</h1>
                </div><!-- /.col --><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('manager.employee.store')}}">
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
                                <label for="inputName">Tên</label>
                                <input type="text" name="name" id="inputName" class="form-control @if($errors->has('name'))  border border-info @endif">
                                @if($errors->has('name'))
                                    <span class="errorCustom">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email"  class="form-control @if($errors->has('email'))  border border-info @endif" >
                                @if($errors->has('email'))
                                    <span class="errorCustom">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Số điện thoại</label>
                                <input name="phone" type="number"  class="form-control @if($errors->has('phone'))  border border-info @endif" >
                                @if($errors->has('phone'))
                                    <span class="errorCustom">{{$errors->first('phone')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Quận huyện</label>
                                <select  class="form-control custom-select" name="district">
                                    <option value="" disabled="" selected >Hà Nội</option>
                                    @foreach($address as $a)
                                        <option value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('district'))
                                    <span class="errorCustom">{{$errors->first('district')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Xã phường</label>
                                <select class="form-control custom-select" name="ward">
                                </select>
                                @if($errors->has('ward'))
                                    <span class="errorCustom">{{$errors->first('ward')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Mật khẩu</label>
                                <input type="password" name="password" id="inputClientCompany" class="form-control  @if($errors->has('phone'))  border border-info @endif">
                                @if($errors->has('password'))
                                    <span class="errorCustom">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Nhập lại mật khẩu</label>
                                <input type="password" name="password_confirmation" id="inputProjectLeader" class="form-control  @if($errors->has('phone'))  border border-info @endif">
                                @if($errors->has('password_confirmation'))
                                    <span class="errorCustom">{{$errors->first('password_confirmation')}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        There were some errors with your request.--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}
            </div>
            <div class="row " style="margin-bottom: 40px" >
                <div class="col-12">
                    <input type="submit" value="Tạo " class="btn btn-success float-left">
                </div>
            </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script src="{{asset("js/getAddress.js")}}"></script>
@endsection
