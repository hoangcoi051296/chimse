@extends('manager.layout.layout')

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

                    <a  href="{{route('manager.helper.create')}}" class="btn btn-success float-right " style="margin-bottom: 10px">Tạo người giúp việc</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>PhoneNumber</th>
                                    <th>Address</th>
                                    <th>Rating</th>
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
                                        <a href="{{route('manager.helper.edit',['id'=>$helper->id])}}" >Edit</a>
                                        <a href="{{route('manager.helper.delete',['id'=>$helper->id])}}" >Delete</a>
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
                                <li class="page-item"><a class="page-link" href="#">«</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">»</a></li>
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
