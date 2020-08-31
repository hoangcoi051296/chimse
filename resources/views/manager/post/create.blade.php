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
                                        <div class="input-group-append" data-target="#timepickerStart"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="time_start"
                                               class="form-control datetimepicker-input @if($errors->has('time_start'))  border border-info @endif"
                                               data-target="#timepickerStart" id="timepickerStart">

                                    </div>
                                    @if($errors->has('time_start'))
                                        <span class="errorCustom">{{$errors->first('time_start')}}</span>
                                @endif
                                <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>Thời gian kết thúc</label>
                                    <div class="input-group">
                                        <div class="input-group-append" data-target="#timepickerEnd"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        <input type="text" name="time_end"
                                               class="form-control datetimepicker-input @if($errors->has('time_end'))  border border-info @endif"
                                               data-target="#timepickerEnd" id="timepickerEnd">

                                    </div>
                                    @if($errors->has('time_end'))
                                        <span class="errorCustom">{{$errors->first('time_end')}}</span>
                                @endif
                                <!-- /.input group -->
                                </div>


                                <div class="form-group">
                                    <label>Chọn người thuê</label>
                                    <select class="chzn-select " data-placeholder="Chọn người thuê...."
                                            name="customer_id" style="width:100%">
                                        <option value="" selected disabled>Chọn</option>
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
                                    <select class="form-control custom-select option" name="district_id"
                                            id="district"
                                    >
                                        <option value="">Hà Nội</option>
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district_id'))
                                        <br/><span class="errorCustom">{{$errors->first('district_id')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Xã phường :</label>
                                    <select class="form-control" name="ward_id" id="ward">
                                    </select>
                                    @if($errors->has('ward_id'))
                                        <span class="errorCustom">{{$errors->first('ward_id')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Nhập địa chỉ chi tiết :</label>
                                    <input class="form-control" name="addressDetails">

                                    @if($errors->has('addressDetails'))
                                        <span class="errorCustom">{{$errors->first('addressDetails')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="button" data-toggle="modal" class="btn btn-secondary"
                                            data-target="#fullHeightModalRight"> Chọn người giúp việc
                                    </button>
                                </div>
                                <div id="employee" style="margin-left: 10px"></div>
                                <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel"
                                     aria-hidden="true">

                                    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                                    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">


                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="form-group filterData">
                                                    @if(Request::get('district'))
                                                        <input id="districtPost" value="{{Request::get('district')}}"
                                                               hidden>
                                                    @endif
                                                    <select class="form-control" name="district" id="districtFind">
                                                        <option value="">Quận huyện</option>
                                                        @foreach($address as $a)
                                                            <option {{Request::get('district')==$a->maqh?"selected='selected":''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group filterData ">
                                                    <select class="form-control" name="rating" id="rating" >
                                                        <option {{Request::get('rating')==null ?"selected='selected'":'' }} value="">
                                                            Đánh giá
                                                        </option>
                                                        <option {{Request::get('rating')=='low' ?"selected='selected'":'' }} value="low">
                                                            Thấp đến cao
                                                        </option>
                                                        <option {{Request::get('rating')=='high' ?"selected='selected'":'' }} value="high">
                                                            Cao đến thấp
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="filterData" style="width: 45%">
                                                    <input value="{{Request::get('search')}}" id="findEmployee"
                                                           placeholder="Tìm kiếm" type="text" class="form-control"
                                                           name="search">
                                                </div>
                                                <span class="input-group-append">
                                                 <button type="button" onclick="chooseEmployee()"
                                                         class="btn btn-info btn-flat">Go!</button>

                                                </span>
                                                <span class="input-group-append">
                                                    <button type="button" onclick="refresh()"
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
                                                        <th>Địa chỉ</th>
                                                        <th>Rating</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($employees as $employee)
                                                        <tr>
                                                            <td><input type="radio" name="employee_id"
                                                                       data-employee="{{$employee}}"
                                                                       value="{{$employee->id}}"></td>
                                                            @if($employee->avatar)
                                                                <td><img style="width: 40px;height: 40px"
                                                                         src="{{asset($employee->avatar)}}"></td>
                                                            @else
                                                                <td><img src="{{asset('images/avt.jpeg')}}"
                                                                         style="width:40px;height: 40px"></td>
                                                            @endif
                                                            <td>{{ $employee->name}}</td>
                                                            <td>{{$employee->email}}</td>
                                                            <td>{{$employee->phone}}</td>
                                                            <td>
                                                                @if($employee->ward_id && $employee->district_id)
                                                                    {{$employee->ward->name}}
                                                                    , {{$employee->district->name}}
                                                                @endif
                                                            </td>
                                                            <?php $count = \Illuminate\Support\Facades\DB::table('feedback')->where('employee_id',$employee->id)->count() ?>
                                                            <td>{{$employee->avgRate}}/5 ( {{$count}} đánh giá)</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-primary" onclick="saveData()"
                                                        id="save" data-dismiss="modal">Lưu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" name="price" id="inputName"
                                           class="form-control @if($errors->has('time'))  border border-info @endif">
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
        $(function () {
            $(".chzn-select").chosen();
        });
    </script>
    <script type="text/javascript">
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
    <script type="text/javascript">
        function saveData() {
            $('#changeStatusPost').attr("disabled", true)
            var html = ''
            $('#employee').html('')
            var x = $('input[name="employee_id"]:checked').data('employee');
            var y = JSON.parse(document.querySelector('input[name="employee_id"]').getAttribute('data-employee'))
            console.log(y)
            html += "<address>"
            html += "<ins><i>" + x.name + "</i></ins><br>"
            html += "Phone: " + x.phone + "<br>"
            html += "Email: " + x.email + ""
            html += "</address>"
            $('#employee').html(html)
        }

        function chooseEmployee() {
            var district = $('#districtFind').val()
            var rating = $('#rating').val()
            var search = $('#findEmployee').val()
            var url = "{!! route('manager.post.create') !!}";
            url = url + '?district=' + district + '&rating=' + rating + '&search=' + search;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
            $("#employee").load(" #employee > * ");
        }

        function refresh() {
            var url = "{!! route('manager.post.create') !!}";
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }
    </script>
@endsection
