<?php
//$listStatus = listStatus();
?>
@extends('manager.layout.layout')
<style>
    .filterData {
        margin-right: 20px;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách công việc</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    @include('manager.components.notified')
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form class=" ml-3" id="formPost">

                        <div class="input-group input-group-sm">
                            <div class="form-group filterData">
                                @if(Request::get('district'))
                                    <input id="districtPost" value="{{Request::get('district')}}" hidden>
                                @endif
                                <select class="form-control" name="district" id="district">
                                    <option value="">Quận huyện</option>
                                    @foreach($address as $a)
                                        <option {{Request::get('district')==$a->maqh?"selected='selected":''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group filterData" style="width: 200px">
                                @if(Request::get('ward'))
                                    <input id="wardPost" value="{{Request::get('ward')}}" hidden>
                                @endif
                                <select class="form-control" name="ward" id="ward">
                                    <option selected="selected" value="">Xã phường</option>
                                </select>
                            </div>
                            <div class="form-group filterData ">
                                <select class="form-control" name="status">
                                    <option {{Request::get('status')==null ?"selected='selected'":'' }} value="">Trạng
                                        thái
                                    </option>
                                    @foreach(listPostStatus() as $status)
                                        <option {{Request::get('status')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group filterData">
                                @if(Request::get('category'))
                                    <input id="districtPost" value="{{Request::get('category')}}" hidden>
                                @endif
                                <select class="form-control" name="category" id="category">
                                    <option value="">Danh mục</option>
                                    @foreach($categories as $category)
                                        <option {{Request::get('category')==$category->id?"selected='selected":''}} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group filterData" style="width: 200px">
                                @if(Request::get('attribute'))
                                    <input id="attributePost" value="{{Request::get('attribute')}}" hidden>
                                @endif
                                <select class="form-control" name="attribute" id="attribute">
                                    <option selected="selected" value="">Thuộc tính</option>
                                </select>
                            </div>
                            <div class="form-group filterData ">
                                <select class="form-control" name="timeFilter">
                                    <option {{Request::get('timeFilter')==null ?"selected='selected'":'' }} value="">Thời gian</option>
                                    <option {{Request::get('timeFilter')=='hours' ?"selected='selected'":'' }} value="hours">2 tiếng</option>
                                    <option {{Request::get('timeFilter')=='day' ?"selected='selected'":'' }} value="day">Ngày</option>
                                    <option {{Request::get('timeFilter')=='week' ?"selected='selected'":'' }} value="week">Tuần</option>
                                    <option {{Request::get('timeFilter')=='month' ?"selected='selected'":'' }} value="month">Tháng</option>
                                </select>
                            </div>

                        </div>
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text"
                                           class="form-control typeahead" name="search" id="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.post.index')}}" class="btn btn-secondary btn-flat"><i
                                                 class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                            </div>
                        </div>
                        <input type="date" name="startTime">
                        <input type="date" name="finishDate">


                        <div class="form-group input-group-sm float-left " style="width: 120px">
                            <select class="form-control" id="perPage" name="per_page">
                                <option {{Request::get('per_page')==null ?"selected='selected'":'' }} value="">Hiển thị</option>
                                <option {{Request::get('per_page')=='15' ?"selected='selected'":'' }} value="15">15 kết quả</option>
                                <option {{Request::get('per_page')=='30' ?"selected='selected'":'' }} value="30">30 kết quả</option>
                                <option {{Request::get('per_page')=='50' ?"selected='selected'":'' }} value="50">50 kết quả</option>
                                <option {{Request::get('per_page')=='100' ?"selected='selected'":'' }} value="100">100 kết quả</option>
                            </select>
                        </div>
                        <a  href="{{route('manager.post.create')}}" class="btn btn-success float-right " style="margin-bottom: 10px">Tạo bài đăng</a>
                    </form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Khách hàng</th>
                                    <th>Danh mục</th>
                                    <th style="width: 8%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <form>
                                            @csrf
                                            <td>{{ $post->title}}</td>
                                            <td>
                                                @if($post->ward_id)
                                                    {{$post->ward->name}}
                                                @endif
                                                @if($post->district_id),
                                                {{$post->ward->district->name}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row postStatus" data-value="{{$post->id}}">
                                                    {{getPostStatus($post->status)}}</div>
                                            </td>
                                            <td>{{$post->customer->name}}</td>
                                            <td>@if($post->category)
                                                    {{$post->category->name}}
                                                @endif</td>
                                            <td class="align-self-center">
                                                <a href="{{ route('manager.post.details',['id' => $post->id])}}" data-toggle="tooltip" title="Xem chi tiết"
                                                   class="btn btn-info btn-xs"><i class="far fa-eye"></i></a>
                                                @if($post->status==1)
                                                <a id="{{$post->id}}"  data-toggle="tooltip" title="Duyệt bài"
                                                   class="btn btn-primary btn-xs changeStatus"><i class="fas fa-exchange-alt"></i></a>
                                                @else
                                                    <a
                                                       class="btn btn-primary btn-xs disabled"><i
                                                                class="fas fa-exchange-alt"></i></a>
                                                @endif
{{--                                                @if($post->status==1||$post->status==2)--}}
{{--                                                <a href="{{ route('manager.post.edit',['id' => $post->id])}}" data-toggle="tooltip" title="Sửa bài"--}}
{{--                                                   class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>--}}
{{--                                                @else--}}
{{--                                                    <a href="#" data-toggle="tooltip"--}}
{{--                                                       class="btn btn-primary btn-xs disabled"><i class="fa fa-edit"></i></a>--}}
{{--                                                @endif--}}

{{--                                                @if(Gate::forUser(Auth::guard('manager')->user())->allows('editPost',$post))--}}
                                                <a href="{{ route('manager.post.edit',['id' => $post->id])}}" data-toggle="tooltip" title="Sửa bài"
                                                   class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
{{--                                                @endif--}}
                                                <a href="{{ route('manager.post.delete',['id'=> $post->id])}}" data-toggle="tooltip" title="Xoá bài"
                                                   onclick="return confirm('Bạn muốn xóa không?');"
                                                   class="btn btn-danger btn-xs "><i
                                                            class="fa fa-trash"></i></a>

                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{$posts->appends(request()->query())->links()}}
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        var urlStatus = "{{ url('manager/post/changeStatus') }}";
        $(".changeStatus").click(function () {
            var id = this.id;
            var token = $("input[name='_token']").val();

            $.ajax({
                url: urlStatus,
                method: 'POST',
                data: {
                    id: id,
                    _token: token,
                },
                success: function (data) {
                    location.reload();
                }
            });
        });

        var urlAttribute = "{{route('getAttributes')}}";
        $("#category").change(function(){
            var category = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: urlAttribute,
                method: 'GET',
                data: {
                    category_id: category,
                    _token: token,
                },
                success: function(data) {
                    console.log(data)
                    $("#attribute").html('<option selected="selected" value="">Thuộc tính</option>');
                    $.each(data, function(key, value){
                        $("#attribute").append(
                            "<option  value=" + value.id + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });

        $(document).ready(function () {

            var category =$('#districtPost').val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: urlAttribute,
                method: 'GET',
                data: {
                    category_id: category,
                    _token: token,
                },
                success: function (data) {
                    $("#attribute").html(
                        '<option selected="selected" value="">Thuộc tính</option>');

                    $.each(data, function (key, value) {
                        $("#attribute").append(
                            "<option value=" + value.id + ">" + value.name + "</option>"
                        );

                    });
                    var attribute =$('#attributePost').val();
                    console.log(attribute)
                    $('#attribute option[value='+attribute+']').attr('selected',true)
                }
            });
        });


    </script>
    <script type="text/javascript">
        $(function () {
            $('#perPage').change(function () {
                $('#formPost').submit(
                )
            })
        })
    </script>
@endsection
