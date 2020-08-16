@extends('customer.layout.layout')

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
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('customer.index')}}"></a>Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('customer.post.update',['id' => $post->id])}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">General</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="inputName">Title</label>
                                    <input type="text" name="title" id="inputName" value="{{$post->title}}"
                                           class="form-control @if($errors->has('description')) error-input @endif">
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Description</label>
                                    <textarea class="form-control @if($errors->has('description')) error-input @endif"
                                              name="description" id="description1" rows="3">{{$post->description}}</textarea>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Date and time:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-clock"></i></span>
                                        </div>
                                        <input type="text" name="time" class="form-control float-right" id="reservationtime">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">District</label>
                                    <select class="form-control @if($errors->has('description')) error-input @endif custom-select option"
                                            name="district" type="text">
                                        @foreach($address as $a)
                                            @if($post->ward->district->maqh == $a->maqh)
                                                <option value="{{$a->maqh}}" selected>{{$a->name}}</option>
                                            @else
                                                <option value="{{$a->maqh}}">{{$a->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Ward</label>
                                    <select class="form-control @if($errors->has('description')) error-input @endif"
                                            name="ward">
                                        <option value="{{$post->ward->xaid}}" selected>{{$post->ward->name}}
                                        </option>
                                    </select>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Price</label>
                                    <input type="text" name="price" id="inputName" value="{{$post->price}}"
                                           class="form-control @if($errors->has('description')) error-input @endif">
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Category</label>
                                    <select name="category_id"
                                            class="form-control @if($errors->has('description')) error-input @endif"
                                            id="category">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            @if($post->category_id == $cat->id)
                                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                                            @endif
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Update post" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <script>
        $(function() {
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePicker24Hour:true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
        });
    </script>

    <!-- /.content -->
@endsection
