@extends('manager.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo phân quyền</h1>
                </div>
                <div class="col-sm-6">
                    @include('manager.components.notified')
                </div>
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('manager.role.store')}}">
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
                                    <label for="inputName">Vai trò</label>
                                    <input type="text" name="name" id="inputName" class="form-control @if($errors->has('name'))  border border-info @endif ">
                                    @if($errors->has('name'))
                                        <span style="margin-left: 5px;color: firebrick">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Tên</label>
                                    <div class="form-group row" style="margin-bottom: 5px" >
                                        @foreach($permissions as $permission)
                                            <div class="checkbox col-md-4" >
                                                <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" ><label style="margin-left: 15px">{{$permission->name}} </label>
                                            </div>
                                        @endforeach
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
                        <input type="submit" value="Tạo" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
