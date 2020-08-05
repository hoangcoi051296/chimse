@extends('manager.layout.layout')
<style type="text/css">
    .delete{
        color: red;
        text-decoration: none;
    }
    .delete:hover{
        color: indianred;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách người giúp việc</h1>
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
            <div class="row">
                <div class="col-md-12">

                        <form class=" ml-3">

                            <div class="input-group input-group-sm">
                                <div class="form-group">
                                    <select class="form-control" name="address">
                                        <option value="">Địa chỉ</option>
                                        @foreach($address as $a)
                                        <option {{Request::get('address')==$a->maqh ?"selected='selected'":''}}  value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="card">
                                <div class="input-group input-group-sm">
                                    <div class="input-group input-group-sm">
                                        <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text" class="form-control" name="search">
                                        <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                    <a  href="{{route('manager.employee.create')}}" class="btn btn-success float-right " style="margin-bottom: 10px">Tạo người giúp việc</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Đánh giá</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($helpers as $helper)
                                <tr>
                                    <td>{{$helper->id}}</td>
                                    <td>{{$helper->name}}</td>
                                    <td>{{$helper->email}}</td>
                                    <td>{{$helper->phone}}</td>
                                    <td>{{$helper->Address->name}}</td>
                                    <td></td>
                                    <td>
                                        <a class="edit" href="{{route('manager.employee.edit',['id'=>$helper->id])}}" ><i class="fas fa-edit"></i></a>
                                        <a class="delete" onclick="return confirm('Are you sure?')" href="{{route('manager.employee.delete',['id'=>$helper->id])}}" ><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <p>Không tìm thấy</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">

                                    <li>
                                        <a href="" title="">{{$helpers->appends(request()->query())->links()}}  </a>
                                    </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
