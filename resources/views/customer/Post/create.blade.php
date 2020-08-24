@extends('customer.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo bài đăng</h1>
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
            <form method="post" action="{{route('customer.post.store')}}">
                @csrf
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
                                    <input type="text" name="title" id="inputName"
                                           class="form-control @if($errors->has('title')) error-input @endif">
                                    @if($errors->has('title'))
                                        <div class="messages-error">
                                            {{$errors->first('title')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Mô tả</label>
                                    <textarea class="form-control" name="description" id="description1" rows="3"></textarea>
                                    @if($errors->has('description'))
                                        <div class="messages-error">
                                            {{$errors->first('description')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Thời gian:</label>

                                    <div class="input-group">
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="time" class="form-control @if($errors->has('title')) error-input @endif datetimepicker-input" data-target="#timepicker" id="timepicker">
                                    </div>
                                    <!-- /.input group -->
                                    @if($errors->has('time'))
                                        <div class="messages-error">
                                            {{$errors->first('time')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Quận huyện</label>
                                    <select class="form-control @if($errors->has('district_id')) error-input @endif custom-select option"
                                            name="district_id" type="text" id="district">
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district_id'))
                                        <div class="messages-error">
                                            {{$errors->first('district_id')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Xã phường</label>
                                    <select class="form-control @if($errors->has('ward_id')) error-input @endif"
                                            name="ward_id" id="ward">
                                    </select>
                                    @if($errors->has('ward_id'))
                                        <div class="messages-error">
                                            {{$errors->first('ward_id')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ chi tiết</label>
                                    <input type="text" name="addressDetails"
                                           class="form-control @if($errors->has('addressDetails')) error-input @endif">
                                    @if($errors->has('addressDetails'))
                                        <div class="messages-error">
                                            {{$errors->first('addressDetails')}}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" name="price" id="inputName"
                                           class="form-control @if($errors->has('price')) error-input @endif">
                                    @if($errors->has('price'))
                                        <div class="messages-error">
                                            {{$errors->first('price')}}
                                        </div>
                                    @endif
                                </div>
                                <input name="customer_id" value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->id}}" hidden>
                                <div class="form-group">
                                    <label for="inputName">Danh mục</label>
                                    <select name="category_id"
                                            class="form-control @if($errors->has('category')) error-input @endif"
                                            id="category_id">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                        <div class="messages-error">
                                            {{$errors->first('category_id')}}
                                        </div>
                                    @endif
                                </div>
                                <div id="attributes">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Create post" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
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

