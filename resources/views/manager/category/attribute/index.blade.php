@extends('manager.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách thuộc tính</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/')}}"></a>Danh sách</li>
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

                    <a href="{{route('manager.attribute.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo thuộc tính</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Danh mục</th>
                                    <th>Tên thuộc tính</th>
                                    <th>Kiểu hiển thị</th>
                                    <th>Giá trị</th>
                                    <th style="width: 113px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $attribute)
                                    <tr>
                                        <td>{{$attribute->category->name}}</td>
                                        <td>{{ $attribute->name}}</td>
                                        <td>
                                            {{$attribute->type}}
                                        </td>
                                        <?php  if ($attribute->options){
                                            $options = json_decode($attribute->options, true);
                                        }?>
                                        <td>
                                            @if($attribute->options)
                                            <ul>
                                                @foreach($options as $option)
                                                    <li>{{$option}}</li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manager.attribute.edit',['id' => $attribute->id])}}"
                                               class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('manager.attribute.delete',['id'=> $attribute->id])}}"
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
