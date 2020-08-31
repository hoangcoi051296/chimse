@extends('manager.layout.layout')
<style type="text/css">
    .filterData{
        margin-right: 30px;
    }
</style>
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Danh sách danh mục</h1>
            </div>
            <div class="col-sm-6">
                @include('manager.components.notified')
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
                <form class=" ml-3 form">

                    <div class="input-group input-group-sm">
                        <div class="form-group filterData ">
                            <input type="date" value="{{Request::get('create_from')}}" class="form-control" name="create_from">
                        </div>
                        <div class="form-group filterData ">
                            <input type="date" value="{{Request::get('create_to')}}" class="form-control" name="create_to">
                        </div>
                        <div class="col-6">
                                <div class="input-group ">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text"
                                           class="form-control" name="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.category.index')}}"  class="btn btn-secondary btn-flat"><i class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                        </div>
                    </div>
                </form>
                <a href="{{route('manager.category.create')}}" class="btn btn-success float-right "
                   style="margin-bottom: 10px">Tạo danh mục</a>
            </div>


            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th style="width: 113px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->created_at}}</td>
                                    <td>{{$category->updated_at}}</td>
                                    <td>
                                        <a href="{{ route('manager.category.edit',['id' => $category->id])}}"
                                            class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('manager.category.delete',['id'=> $category->id])}}"
                                            onclick="return confirm('Bạn muốn xóa không?');" class="btn btn-danger"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
{{--                        {{$categories->links()}}--}}
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
