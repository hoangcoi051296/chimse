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
                                    <input type="text" name="description" class="form-control">
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
                        <input type="submit" value="Create post" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        var url = "{{ url('manager/post/showWard') }}";
        $("select[name='district']").change(function () {
            var address = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    address: address,
                    _token: token,
                },
                success: function (data) {
                    console.log(data)
                    $("select[name='ward']").html('');
                    $.each(data, function (key, value) {
                        console.log(value)
                        $("select[name='ward']").append(
                            "<option value=" + value.xaid + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });

        function chooseCustomer(customer) {
            var url = "{!! route('manager.post.create',['search' => '']) !!}" + customer;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }
    </script>
@endsection
