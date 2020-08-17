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
            <form method="post" action="{{route('manager.post.update',['id'=>$post->id])}}">
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
                                    <input type="text" value="{{$post->title}}" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Mô tả chi tiết</label>
                                    <div id="description" style="background-color: whitesmoke; border-radius: 10px; height: 150px">
                                        {!!$post->description!!}
                                    </div>

                                </div>
                                <div class="form-group" style="padding-top: 50px">
                                    <label for="inputName"> Người thuê : </label>
                                    <input name="customer_id" value="{{$post->customer_id}}" hidden>
                                    <a href="#"> <span>{{$post->customer->name}}</span></a>
                                </div>
                                <div class="form-group">
                                    <label>Chọn quận huyện:</label>
                                    @if($post->district_id)
                                        <input id="districtPost" value="{{$post->ward->district->maqh}}" hidden>
                                    @endif
                                    <select class="form-control custom-select option" name="district"
                                            type="text">
                                        <option value="">Hà Nội</option>
                                        @foreach($address as $a)
                                            <option
                                                {{$post->district_id?$post->district->maqh==$a->maqh?"selected='selected'":'':''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Chọn phường xã:</label>
                                    @if($post->ward_id)
                                        <input id="wardPost" value="{{$post->ward->xaid}}" hidden>
                                    @endif
                                    <select class="form-control" name="ward" id="ward">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Giá</label>
                                    <input type="text" value="{{$post->price}}" name="price" id="inputName"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Danh mục</label>
                                    <input value="{{$post->category_id}}" id="category_id" hidden>
                                    <select name="category_id" class="form-control" id="category">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            <option
                                                {{$post->category_id==$cat->id?"disabled".' '."selected='selected'":''}} value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="attributes">
                                    @foreach(json_decode($post->attributes,true) as $key =>$attributes)
                                        <div class="form-group">
                                            <label>{{getAttributes($key)->name}}</label>
                                            @if(getAttributes($key)->type=='select')
                                                <select name="attributes[{{getAttributes($key)->id}}]"
                                                        class="form-control">
                                                    @foreach (json_decode(getAttributes($key)->options,true) as $keyOp => $option)
                                                        <option
                                                            {{$attributes==$keyOp?"selected='selected'":''}} value="{{$keyOp}}">{{$option}}</option>
                                                    @endforeach
                                                </select>
                                            @elseif(getAttributes($key)->type=='radio')
                                                @foreach (json_decode(getAttributes($key)->options,true) as $keyOp => $option)
                                                    <label style="margin-left: 15px"><input type="radio" {{$attributes==$keyOp?"checked":''}} value="{{$keyOp}}" name="attributes[{{getAttributes($key)->id}}]">{{$option}}</label>
                                                @endforeach
                                            @elseif(getAttributes($key)->type=='textarea')
                                                <div class="row">
                                                    <textarea class="form-control" name="attributes[{{getAttributes($key)->id}}]"
                                                              rows="4" cols="50">{{$attributes}}
                                                    </textarea>
                                                    @elseif(getAttributes($key)->type=='input')
                                                        <div class="row">
                                                    <input class="form-control" name="attributes[{{getAttributes($key)->id}}]"
                                                        value="{{$attributes}}"      >
                                                    @endif
                                                    @endforeach
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
                    </div>
                    <div class="row " style="margin-bottom: 40px">
                        <div class="col-12">
                            <input type="submit" value="Cập nhật" class="btn btn-success float-left">
                        </div>
                    </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.4/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            inline: true
        });
    </script>
    <script src="{{asset("js/getAddress.js")}}"></script>
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
        $(document).ready(function () {

            var category_id = $('#category_id').val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: '{{route('getAttributes')}}',
                method: 'GET',
                data: {
                    category_id: category_id,
                    _token: token,
                },
                success: function (data) {
                    console.log(data)
                    $("select[name='address']").html('');
                    $.each(data, function (key, value) {
                        $("select[name='ward']").append(
                            "<option value=" + value.xaid + ">" + value.name + "</option>"
                        );

                    });
                    var ward = $('#wardPost').val();
                    $('#ward option[value=' + ward + ']').attr('selected', true)
                }
            });
        });
    </script>
@endsection
