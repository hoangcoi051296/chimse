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
                <h1 class="m-0 text-dark">Sửa thuộc tính</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Danh sách</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form method="post" action="{{route('manager.attribute.update',['id' => $attribute->id])}}">
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
                                <label for="inputName">Tên thuộc tính</label>
                                <input type="text" name="name" id="inputName" class="form-control @if($errors->has('name'))  border border-info @endif"
                                    value="{{$attribute->name}}">
                                @if($errors->has('name'))
                                    <span class="errorCustom">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Danh mục</label>
                                <input disabled name="category_id"  class="form-control" value="{{$attribute->category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="inputName">Kiểu hiển thị</label>
                                <input id="typeAttribute" value="{{$attribute->type}}"  hidden>
                                <select name="type" class="form-control custom-select" id="selectType">
                                    <option {{$attribute->type=='input'?"selected='selected'":''}} value="input">Input</option>
                                    <option {{$attribute->type=='select'?"selected='selected'":''}} value="select">Select</option>
                                    <option {{$attribute->type=='checkbox'?"selected='selected'":''}} value="checkbox">Checkbox</option>
                                    <option {{$attribute->type=='radio'?"selected='selected'":''}} value="radio">Radio</option>
                                    <option {{$attribute->type=='textarea'?"selected='selected'":''}} value="textarea">Textarea</option>
                                </select>
                            </div>
                            <input id="optionAttribute" value="{{$attribute->options}}" hidden>
                            <div id="attributeValue">

                                <div id="newRow"></div>

                        </div>
                            <button id="addRow" type="button" class="btn btn-info invisible">Thêm giá trị</button>

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
                    <input type="submit" value="Update" class="btn btn-success float-left">
                </div>
            </div>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</section>

<!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $('#addRow').addClass('invisible');
            var htmlAttribute=''
            var option = JSON.parse($("#optionAttribute").val())
            for (var j in option) {
                htmlAttribute += '<div class="form-group row" id="inputFormRow" >';
                htmlAttribute += '<div class="col-md-3">';
                htmlAttribute += ' <input type="text" name="key[]" class="form-control " value="'+j+'" placeholder="key">';
                htmlAttribute += '</div>';
                htmlAttribute += '<div class="col-md-6">';
                htmlAttribute += ' <input type="text" name="value[]" class="form-control " value="'+option[j]+'" placeholder="value">';
                htmlAttribute += '</div>';
                htmlAttribute += '<div class="input-group-append col-md-3">';
                htmlAttribute += '<button  type="button" class="btn btn-danger removeRow">Xoá</button>';
                htmlAttribute += '</div>';
                htmlAttribute += '</div>';
            }
            htmlAttribute+='<div id="newRow"></div>'
            $('#addRow').removeClass('invisible')
            $("#attributeValue").html(htmlAttribute)
        })
        // add row
        $("#selectType").change(function () {
            var html = '';
            html += '<label for="inputName">Giá trị</label>'
            html += '<div class="form-group row">'
            html += ' <div class="col-md-3">'
            html += '<input type="text" name="key[]" class="form-control " placeholder="key">'
            html += '</div>'
            html += ' <div class="col-md-6">'
            html += '<input type="text" name="value[]" class="form-control " placeholder="value">'
            html += '</div>'
            html += ' </div>'
            html += '<div id="newRow"></div>'

            var type = $(this).val()
                if (type=="{{$attribute->type}}" &&type!="textarea"&&type!="input"){
                    var htmlAttribute=''
                    var option = JSON.parse($("#optionAttribute").val())
                    for (var j in option) {
                        htmlAttribute += '<div class="form-group row" id="inputFormRow" >';
                        htmlAttribute += '<div class="col-md-3">';
                        htmlAttribute += ' <input type="text" name="key[]" class="form-control " value="'+j+'" placeholder="key">';
                        htmlAttribute += '</div>';
                        htmlAttribute += '<div class="col-md-6">';
                        htmlAttribute += ' <input type="text" name="value[]" class="form-control " value="'+option[j]+'" placeholder="value">';
                        htmlAttribute += '</div>';
                        htmlAttribute += '<div class="input-group-append col-md-3">';
                        htmlAttribute += '<button type="button" class="btn btn-danger removeRow">Xoá</button>';
                        htmlAttribute += '</div>';
                        htmlAttribute += '</div>';
                    }
                    htmlAttribute+='<div id="newRow"></div>'
                    $('#addRow').removeClass('invisible')
                     $("#attributeValue").html(htmlAttribute)
                }else
                {
                    if (type == "input"||type === "textarea") {
                        $("#attributeValue").html('')
                        $('#addRow').addClass('invisible');

                    } else {
                        $('#addRow').removeClass('invisible');
                        $("#attributeValue").html(html)
                    }
                }

        });
        $("#addRow").click(function () {
            var html1 = '';
            html1 += '<div class="form-group row" id="inputFormRow" >';
            html1 += '<div class="col-md-3">';
            html1 += ' <input type="text" name="key[]" class="form-control " placeholder="key">';
            html1 += '</div>';
            html1 += '<div class="col-md-6">';
            html1 += ' <input type="text" name="value[]" class="form-control " placeholder="value">';
            html1 += '</div>';
            html1 += '<div class="input-group-append col-md-3">';
            html1 += '<button  type="button" class="btn btn-danger removeRow">Xoá</button>';
            html1 += '</div>';
            html1 += '</div>';

            $('#newRow').append(html1);
        });

        // remove row
        $(document).on('click', '.removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
