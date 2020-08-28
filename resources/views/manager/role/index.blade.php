@extends('manager.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách thuộc tính</h1>
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
            <div class="row">
                <div class="col-md-12">

                    <form class=" ml-3">
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

                    <a href="{{route('manager.role.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo vai trò</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 25%">Vai trò</th>
                                    <th>Các quyền</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @if($role->permissions)
                                                <ul class="row">
                                                    @foreach($role->permissions as $permission)
                                                        <li class="col-6">{{$permission->name}}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <a style="margin-left: 10px" href="{{ route('manager.role.edit',['id' => $role->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a  style="margin-left: 10px" href="{{ route('manager.role.delete',['id'=> $role->id])}}"
                                               onclick="return confirm('Bạn muốn xóa không?');"
                                               class="btn btn-danger"><i
                                                    class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
