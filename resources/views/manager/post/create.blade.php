@extends('manager.layout.layout')
@section('style')
    <style>
        .errorCustom {
            margin-left: 5px;
            font-style: italic;
            color: firebrick;
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo bài đăng</h1>
                </div><!-- /.col -->
                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('manager.post.store')}}">
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
                                    <label for="inputName">Tiêu đề</label>
                                    <input type="text" name="title"
                                           class="form-control @if($errors->has('title'))  border border-info @endif">
                                    @if($errors->has('title'))
                                        <span class="errorCustom">{{$errors->first('title')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Mô tả chi tiết</label>
                                    <div id="description"
                                         class="@if($errors->has('description'))  border border-info @endif"
                                         style="background-color: whitesmoke; border-radius: 10px; height: 150px">
                                    </div>
                                    @if($errors->has('description'))
                                        <span class="errorCustom">{{$errors->first('description')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Thời gian bắt đầu</label>
                                    <div class="input-group">
                                        <div class="input-group-append" data-target="#timepicker"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="time"
                                               class="form-control datetimepicker-input @if($errors->has('time'))  border border-info @endif"
                                                data-target="#timepicker" id="timepicker">

                                    </div>
                                    @if($errors->has('time'))
                                        <span class="errorCustom">{{$errors->first('time')}}</span>
                                    @endif
                                <!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <label>Chọn người thuê</label>
                                    <select class="chzn-select " data-placeholder="Chọn người thuê...."  name="customer_id" style="width:100%">
                                        <option value="" selected disabled >Chọn</option>
                                        @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('customer_id'))
                                        <br/><span class="errorCustom">{{$errors->first('customer_id')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Quận huyện</label>
                                    <select class="form-control custom-select option" name="district"
                                            type="text">
                                        <option value="">Hà Nội</option>
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district'))
                                        <br/><span class="errorCustom">{{$errors->first('district')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Xã phường :</label>
                                    <select class="form-control" name="ward">
                                    </select>
                                    @if($errors->has('ward'))
                                        <span class="errorCustom">{{$errors->first('ward')}}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" name="price" id="inputName" class="form-control @if($errors->has('time'))  border border-info @endif">
                                    @if($errors->has('price'))
                                        <span class="errorCustom">{{$errors->first('price')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Danh mục</label>
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category_id'))
                                        <span class="errorCustom">{{$errors->first('category_id')}}</span>
                                    @endif
                                </div>
                                @if($errors->has('attributes.*'))
                                    <span class="errorCustom">{{$errors->first('attributes.*')}}</span>
                                @endif
                                <div id="attributes">
                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Tạo bài đăng" class="btn btn-success float-left">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.4/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            inline: true,

        });
        $(function () {

        });
    </script>
    <script type="text/javascript">
        $(function() {
            $(".chzn-select").chosen();
        });
    </script>
    <script type="text/javascript">
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
                                    html += '<label style="margin-left: 15px" ><input value="' + j + '" type="checkbox"  name="attributes[' + data[i]['id'] + '][]"  >' + options[j] + '</label>'
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
