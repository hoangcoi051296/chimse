@extends('manager.layout.layout')
<style type="text/css">
    .delete {
        color: red;
        text-decoration: none;
    }

    .delete:hover {
        color: indianred;
    }
    .img {
        transition: -webkit-transform 0.25s ease;
        transition: transform 0.25s ease;

    }

    .img:active {
        -webkit-transform: scale(8);transform-origin: 0 25%;
        transform: scale(8) ;
    }
</style>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách người giúp việc</h1>
                </div><!-- /.col -->
               <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form class=" ml-3 form">

                        <div class="input-group input-group-sm">
                            <div class="form-group">
                                @if(Request::get('district'))
                                    <input id="districtPost" value="{{Request::get('district')}}" hidden>
                                @endif
                                <select class="form-control" name="district">
                                    <option value="">Quận huyện</option>
                                    @foreach($address as $a)
                                        <option
                                            {{Request::get('district')==$a->maqh ?"selected='selected'":''}}  value="{{$a->maqh}}">{{$a->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 20px;width: 200px">
                                @if(Request::get('ward'))
                                    <input id="wardPost" value="{{Request::get('ward')}}" hidden>
                                @endif
                                <select class="form-control" name="ward" id="ward">
                                    <option value="">Xã phường</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-left: 20px;width: 200px">
                                <select class="form-control orderByStatus" name="status">
                                    <option value="">Trạng thái</option>
                                    @foreach(employeeStatus() as $status)
                                        <option
                                            {{Request::get('status')==$status['value']&&Request::get('status')!=null ?"selected='selected'":''}} value="{{$status['value']}}">{{$status['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card">
                            <div class="input-group input-group-sm">
                                <div class="input-group input-group-sm">
                                    <input value="{{Request::get('search')}}" placeholder="Tìm kiếm" type="text"
                                           class="form-control" name="search">
                                    <span class="input-group-append">
                                     <button type="submit" class="btn btn-info btn-flat">Go!</button>
                                     </span>
                                    <span class="input-group-append">
                                     <a href="{{route('manager.employee.index')}}"  class="btn btn-secondary btn-flat"><i class="fas fa-redo" style="padding-top: 3px"></i></a>
                                     </span>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a href="{{route('manager.employee.create')}}" class="btn btn-success float-right "
                       style="margin-bottom: 10px">Tạo người giúp việc</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th style="width: 10%">Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th style="width: 10%">Đánh giá trung bình</th>
                                    <th>Trạng thái</th>
                                    <th style="width: 8%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($helpers as $helper)
                                    <tr>
                                        <td><img class="img" src="{{$helper->avatar}}" style="width: 40px;height: 40px"></td>
                                        <td>{{$helper->name}}</td>
                                        <td>{{$helper->email}}</td>
                                        <td>{{$helper->phone}}</td>
                                        <td>
                                            @if($helper->district_id)
                                                {{$helper->ward->district->name}}
                                            @endif
                                            @if($helper->ward_id),
                                                {{$helper->ward->name}}
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="{{ route('manager.employee.details',['id' => $helper->id])}}"
                                               class=" btn-xs btn-default" style="background-color: lightgrey"><i class="far fa-eye"></i></a>
                                            <a class="edit"
                                               href="{{route('manager.employee.edit',['id'=>$helper->id])}}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a class="delete" onclick="return confirm('Are you sure?')"
                                               href="{{route('manager.employee.delete',['id'=>$helper->id])}}"><i
                                                    class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <p>Không tìm thấy</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">

                                <li>
                                    <a href="" title="">{{$helpers->appends(request()->query())->links()}}  </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            var imgs = document.querySelectorAll('.img');
            Array.prototype.forEach.call(imgs, function(el, i) {
                if (el.tabIndex <= 0) el.tabIndex = 10000;
            });
        });
    </script>
{{--    <script type="text/javascript">--}}
{{--        $('img').each(function(){--}}
{{--            $(this).click(function(){--}}
{{--                $(this).width($(this).width()+$(this).width())--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script src="{{asset("js/getAddress.js")}}"></script>
@endsection
