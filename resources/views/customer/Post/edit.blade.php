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
                        <li class="breadcrumb-item active"><a href="{{route('customer.post.index')}}">Danh sách</a></li>
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
                                    <label for="inputName">Tên</label>
                                    <input type="text" name="title" id="inputName" value="{{$post->title}}"
                                           class="form-control @if($errors->has('description')) error-input @endif">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Mô tả</label>
                                    <textarea class="form-control @if($errors->has('description')) error-input @endif" name="description" id="description1" rows="3">{!! $post->description !!}</textarea>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Thời gian:</label>

                                    <div class="input-group">
                                        <div class="input-group-append" data-target="#timepicker"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="time" class="form-control datetimepicker-input"
                                               data-target="#timepicker" id="timepicker"value="{{$post->time}}">

                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Quận huyện:</label>
                                    @if($post->district_id)
                                        <input id="districtPost" value="{{$post->ward->district->maqh}}" hidden>
                                    @endif
                                    <select class="form-control @if($errors->has('description')) error-input @endif custom-select option" name="district"
                                            type="text">
                                        <option value="">Hà Nội</option>
                                        @foreach($address as $a)
                                            <option
                                                    {{$post->district_id?$post->district->maqh==$a->maqh?"selected='selected'":'':''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Xã phường:</label>
                                    @if($post->ward_id)
                                        <input id="wardPost" value="{{$post->ward->xaid}}" hidden>
                                    @endif
                                    <select class="form-control @if($errors->has('description')) error-input @endif" name="ward" id="ward">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" name="price" id="inputName" value="{{$post->price}}"
                                           class="form-control @if($errors->has('description')) error-input @endif">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Danh mục</label>
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
                                </div>
                                <div id="attributes">
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
@endsection
@section('script')
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset("js/getAddress.js")}}"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description1'
        });
        function chooseCustomer(customer) {
            var url = "{!! route('manager.post.create',['search' => '']) !!}" + customer;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }

        $("select[name='category_id']").change(function () {
            var category_id = $(this).val();
            console.log(category_id)
            var token = $("input[name='_token']").val();
            $.ajax({
                url: '{{route('getAttributes')}}',
                method: 'GET',
                data: {
                    category_id: category_id,
                    _token: token,
                },
                success: function (data) {
                    if (data != null) {
                        var html = ''
                        for (i = 0; i < data.length; i++) {
                            html += '<div class="form-group">'
                            html += '<label>' + data[i]['name'] + '</label>'
                            var options = JSON.parse(data[i]['options'])
                            if (data[i]['type'] === 'select') {
                                html += '<select name="attributes[' + data[i]['id'] + ']" class="form-control" >'
                                for (var j in options) {
                                    html += '<option value="' + j + '">' + options[j] + '</option>'
                                }
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'radio') {
                                html += '<div class="row">'
                                for (var j in options) {
                                    html += '<label style="margin-left: 15px" ><input type="radio" value="' + j + '"  name="attributes[' + data[i]['id'] + ']"  >' + options[j] + '</label>'
                                }
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'input') {
                                html += '<div class="row">'
                                html += '<input type="text" placeholder="" class="form-control" name="attributes[' + data[i]['id'] + ']"  >'
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'checkbox') {
                                html += '<div class="row">'
                                for (var j in options) {
                                    html += '<label style="margin-left: 15px" ><input value="' + j + '" type="checkbox"  name="attributes[' + data[i]['id'] + '][value][]"  >' + options[j] + '</label>'
                                }
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'textarea') {
                                html += '<div class="row">'
                                html += '<textarea class="form-control" name="attributes[' + data[i]['id'] + ']" rows="4" cols="50">'
                                html += '</textarea>'
                                html += '</div>'
                                html += '</select>'
                            }
                            html += '</div>'
                        }
                        $('#attributes').html(html);
                    } else {
                        $("#attributes").html('');
                    }
                }
            });
        })

        function chooseCustomer(customer) {
            var url = "{!! route('manager.post.create',['search' => '']) !!}" + customer;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }
    </script>
@endsection

