@extends('manager.layout.layout')

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
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Mô tả chi tiết</label>

                                    <div id="description"
                                         style="background-color: whitesmoke; border-radius: 10px; height: 150px">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#fullHeightModalRight">
                                        Chọn người thuê
                                    </button>
                                </div>
                                <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel"
                                     aria-hidden="true">

                                    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                                    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">


                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title w-100" id="myModalLabel">Chọn người thuê</h4>
                                                <input value="{{Request::get('search')}}" id="findCustomer"
                                                       placeholder="Tìm kiếm" type="text" class="form-control"
                                                       name="search">
                                                <span class="input-group-append">
                                                 <button type="button"
                                                         onclick="chooseCustomer(document.getElementById('findCustomer').value)"
                                                         class="btn btn-info btn-flat">Go!</button>
                                                </span>
                                                <span class="input-group-append">
                                                    <button type="button" onclick="chooseCustomer('')"
                                                            class="btn btn-secondary btn-flat"><i class="fas fa-redo"
                                                                                                  style="padding-top: 3px"></i></button>
                                                    </span>

                                            </div>
                                            <div class="modal-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Chọn</th>
                                                        <th>Ảnh</th>
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                        <th>Số điện thoại</th>
                                                        {{--                                                        <th>Địa chỉ</th>--}}
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($customers as $customer)
                                                        <tr>
                                                            <td><input type="radio" name="customer_id"
                                                                       value="{{$customer->id}}"></td>
                                                            @if($customer->avatar)
                                                                <td><img src="{{$post->avatar}}"></td>
                                                            @else
                                                                <td><img src="{{asset('images/avt.jpeg')}}"
                                                                         style="width:40px;height: 40px"></td>
                                                            @endif
                                                            <td>{{ $customer->name}}</td>
                                                            <td>{{$customer->email}}</td>
                                                            <td>{{$customer->phone}}</td>
                                                            {{--                                                                <td>{{$customer->getAddress->name}}</td>--}}
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    {{$customers->appends(request()->query())->links()}}
                                                </table>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Lưu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputStatus">Địa chỉ</label>
                                    <select class="form-control custom-select option" name="district"
                                            type="text">
                                        <option value="">Hà Nội</option>
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn phường :</label>
                                    <select class="form-control" name="ward">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" name="price" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Danh mục</label>
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="attributes">
                                </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.4/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            inline: true,

        });
        $(function () {
            $('#datetimepicker1').datetimepicker();
        });
    </script>
    <script type="text/javascript">
        function chooseCustomer(customer) {
            var url = "{!! route('manager.post.create',['search' => '']) !!}" + customer;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }

        $("select[name='category_id']").change(function () {
            var category_id = $(this).val();
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
                                html += '<select name="attributes['+data[i]['id']+']" class="form-control" >'
                                for (var j in options) {
                                    html += '<option value="' + j + '">' + options[j] + '</option>'
                                }
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'radio') {
                                html += '<div class="row">'
                                for (var j in options) {
                                    html += '<label style="margin-left: 15px" ><input type="radio" value="'+j+'"  name="attributes['+data[i]['id']+']"  >' + options[j] + '</label>'
                                }
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'input') {
                                html += '<div class="row">'
                                html += '<input type="text" placeholder="" class="form-control" name="attributes['+data[i]['id']+']"  >'
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'checkbox') {
                                html += '<div class="row">'
                                for (var j in options) {
                                    html += '<label style="margin-left: 15px" ><input value="'+j+'" type="checkbox"  name="attributes['+data[i]['id']+'][value][]"  >' + options[j] + '</label>'
                                }
                                html += '</div>'
                                html += '</select>'
                            }
                            if (data[i]['type'] === 'textarea') {
                                html += '<div class="row">'
                                html += '<textarea class="form-control" name="attributes['+data[i]['id']+']" rows="4" cols="50">'
                                html+=    '</textarea>'
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
        });
    </script>
@endsection
