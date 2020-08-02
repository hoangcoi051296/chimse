@extends('manager.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo người giúp việc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Tạo mới</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('manager.helper.store')}}">
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
                                <label for="inputName">Name</label>
                                <input type="text" name="name" id="inputName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Phone Number</label>
                                <input name="phone" type="text"  class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Address</label>
                                <select id="inputStatus" class="form-control custom-select" name="address">
                                    <option selected="" disabled="">Address</option>
                                    @foreach($address as $a)
                                        <option value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" id="inputClientCompany" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputProjectLeader">Repeat Password</label>
                                <input type="password" name="password_confirmation" id="inputProjectLeader" class="form-control">
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
                    <input type="submit" value="Create new Porject" class="btn btn-success float-left">
                </div>
            </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
