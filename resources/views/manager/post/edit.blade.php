@extends('manager.layout.layout')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Sửa bài đăng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('manager.index')}}">Home</a></li>
                    <li class="breadcrumb-item active"><a href="#"></a>Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{route('manager.post.update',['id' => $post->id])}}">
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
                                <label for="inputName">Tiêu đề</label>
                                <input type="text" name="title" id="inputName" value="{{$post->title}}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Mô tả công việc</label>
                                <input type="text" name="description" id="inputName" value="{{$post->description}}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Người thuê :    </label>
                                <input type="text" disabled id="inputName" value="{{$post->employee->name}}"
                                       class="form-control" >
                            </div>
                            <div class="wrap-input100 validate-input m-b-26">
                                <label for="inputName">Địa chỉ làm việc  :  </label>
                                <input type="text" disabled id="inputName" value="{{$post->Address->name}}"
                                       class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="inputName">Giá</label>
                                <input type="text" disabled name="price" id="inputName" value="{{$post->price}}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Danh mục</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">Chọn loại</option>
                                    @foreach ($categories as $category)
                                    @if($post->category_id == $category->id)
                                    <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @endif
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputName">Employee</label>
                                <select name="category_id" class="form-control" id="category">
                                    <option value="">Chọn người giúp việc</option>
                                    @foreach ($categories as $category)
                                        @if($post->category_id == $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @endif
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control select2bs4 select2-hidden-accessible"
                                        style="width: 100%;" data-select2-id="17" tabindex="-1" aria-hidden="true">
                                    @foreach(listStatus() as $list)
                                        @if($list['value']>=$post->status ||$list['value']==0 )
                                        <option value="{{$list['value']}}" {{$list['value']==$post->status?"selected='selected'":''}}>{{$list['name']}}</option>
                                        @endif
                                    @endforeach

                                </select>

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
            <div class="row " style="margin-bottom: 40px">
                <div class="col-12">
                    <input type="submit" value="Update post" class="btn btn-success float-left">
                </div>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection
