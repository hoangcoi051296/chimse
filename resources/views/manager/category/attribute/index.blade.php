@extends('manager.layout.layout')
<style type="text/css">
    .filterData {
        margin-right: 15px;
        width: 150px;
    }
</style>
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

                    <form class=" ml-3 form">

                        <div class="input-group input-group-sm">
                            <div class="form-group filterData">
                                <select class="form-control" name="category">
                                    <option value="">Danh mục</option>
                                    @foreach($categories as $category)
                                        <option
                                            {{Request::get('category')==$category->id?"selected='selected":''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group filterData">
                                <select class="form-control" name="type">
                                    <option value="">Kiểu hiển thị</option>
                                    <option {{Request::get('type')=='input'?"selected='selected":''}} value="input">
                                        Input
                                    </option>
                                    <option {{Request::get('type')=='select'?"selected='selected":''}} value="select">
                                        Select
                                    </option>
                                    <option {{Request::get('type')=='checkbox'?"selected='selected":''}} value="checkbox">
                                        Checkbox
                                    </option>
                                    <option {{Request::get('type')=='radio'?"selected='selected":''}} value="radio">
                                        Radio
                                    </option>
                                    <option {{Request::get('type')=='textarea'?"selected='selected":''}} value="textarea">
                                        Textarea
                                    </option>
                                </select>
                            </div>
                            <div class="form-group filterData ">
                                <input type="date" value="{{Request::get('create_from')}}" class="form-control"
                                       name="create_from">
                            </div>
                            <div class="form-group filterData ">
                                <input type="date" value="{{Request::get('create_to')}}" class="form-control"
                                       name="create_to">
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text"
                                           class="form-control" name="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.attribute.index')}}"
                                        class="btn btn-secondary btn-flat"><i class="fas fa-redo"
                                                                              style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                            </div>
                        </div>

                    </form>

                    <a href="{{route('manager.attribute.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo người giúp việc</a>
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
                                    <th style="width: 20%">Giá trị</th>
                                    <th>Ngày tạo</th>
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
                                        <?php  if ($attribute->options) {
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
                                        <td>{{$attribute->created_at}}</td>
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
