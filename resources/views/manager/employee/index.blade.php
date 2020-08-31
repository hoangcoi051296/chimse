@extends('manager.layout.layout')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<style type="text/css">
    .delete {
        color: red;
        text-decoration: none;
    }
    .fc-popover{
        width: 400px;
    }
    .fc-more-popover{
        width: 400px;
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
    .filterData {
        margin-right: 20px;
        width: 150px;
    }
</style>
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách người giúp việc</h1>
                </div>
                <div class="col-sm-6">
                    @include('manager.components.notified')
                </div>
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
                                <input type="date" value="{{Request::get('create_from')}}" class="form-control" name="create_from">
                            </div>
                            <div class="form-group filterData ">
                                <input type="date" value="{{Request::get('create_to')}}" class="form-control" name="create_to">
                            </div>
                            <div class="form-group filterData ">
                                <select class="form-control" name="rating" id="rating" >
                                    <option {{Request::get('rating')==null ?"selected='selected'":'' }} value="">
                                        Đánh giá
                                    </option>
                                    <option {{Request::get('rating')=='low' ?"selected='selected'":'' }} value="low">
                                        Thấp đến cao
                                    </option>
                                    <option {{Request::get('rating')=='higt' ?"selected='selected'":'' }} value="high">
                                        Cao đến thấp
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class=" col-8" style="margin-left: 50px">
                            <div class="input-group">
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
                                    <th style="width: 8%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($helpers as $helper)
                                    <tr>
                                        <td>
                                            @if($helper->avatar)
                                                <img class="img" src="{{$helper->avatar}}" style="width: 40px;height: 40px">
                                            @else
                                                <img class="img" src="{{asset('images/avt.jpeg')}}" style="width: 40px;height: 40px">
                                            @endif
                                        </td>
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
                                        <td>{{avgRate($helper)}}</td>

                                        <td>
                                            <button type="button" onclick="timeLine({{$helper->id}})" class="btn-xs btn-default" data-toggle="modal" data-target="#modal">
                                                <i class="far fa-eye"></i>
                                            </button>

                                            <a href="{{ route('manager.employee.details',['id' => $helper->id])}}"
                                               class=" btn-xs btn-default" style="background-color: lightgrey"><i class="fas fa-info-circle"></i></a>
                                            <a class="edit" style="margin-left: 3px"
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
                        <div id="SU">

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-1 float-left">

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
        @csrf

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
      function timeLine(id){
          var token = $("input[name='_token']").val();
          $.ajax({
              url: "{{route('getTimeline')}}",
              method: 'GET',
              data: {
                  id: id,
                  token: token,
              },
              success: function (data) {
                  console.log(data)
                  $('#SU').append(data)
                  $('#modal').addClass('show')
              }
          })}
      function closeModal(){
          $('#SU').empty()
         $('#modal').removeClass('show')

      }
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>


@endsection
