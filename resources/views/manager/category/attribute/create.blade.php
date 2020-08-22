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
                    <h1 class="m-0 text-dark">Tạo thuộc tính</h1>
                </div><!-- /.col -->
               <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('manager.attribute.store')}}">
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
                                    <label for="inputStatus">Chọn danh mục</label>
                                    <select name="category_id" class="form-control custom-select">
                                        @foreach($category as $categories)
                                            <option value="{{$categories->id}}">{{$categories->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label for="inputName">Tên thuộc tính</label>
                                    <input type="text" name="name" class="form-control  @if($errors->has('name'))  border border-info @endif ">
                                    @if($errors->has('name'))
                                        <span class="errorCustom">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label for="inputName">Kiểu hiển thị</label>
                                    <select name="type" class="form-control custom-select" id="selectType">
                                        <option value="input">Input</option>
                                        <option value="select">Select</option>
                                        <option value="checkbox">Checkbox</option>
                                        <option value="radio">Radio</option>
                                        <option value="textarea">Textarea</option>
                                    </select>
                                </div>
                                @if($errors->has('key.*'))
                                    <span class="errorCustom">{{$errors->first('key.*')}}</span>
                                @endif

                                <div id="attributeValue">
                                    <div id="newRow"></div>
                                </div>
                                <button id="addRow" type="button" class="btn btn-info invisible">Thêm giá trị</button>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Tạo " class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
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
            if (type === "input"||type === "textarea") {
                $("#attributeValue").html('')
                $('#addRow').addClass('invisible');

            } else {
                $('#addRow').removeClass('invisible');
                $("#attributeValue").html(html)
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
            html1 += '<button id="removeRow" type="button" class="btn btn-danger">Xoá</button>';
            html1 += '</div>';
            html1 += '</div>';

            $('#newRow').append(html1);
        });

        // remove row
        $(document).on('click', '#removeRow', function () {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endsection
