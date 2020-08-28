<?php use App\Models\Post ?>
@extends('manager.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-info">
                        <h3><i class="fas fa-info"></i> Bài đăng : #{{$post->id}}</h3>
                        <input id="postID" value="{{$post->id}}" hidden>
                        <h5>Trạng thái : {{getStatus($post->status)}}</h5>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                                    @if($post->status==\App\Models\Post::ChoDuyet||$post->status==\App\Models\Post::DaDuyet)
                                    <small class="float-right"><button type="button"   data-toggle="modal" class="btn btn-secondary"
                                                              data-target="#fullHeightModalRight"> Chọn người giúp việc
                                        </button></small>
                                    @elseif($post->status==\App\Models\Post::TimDuocNGV)
                                        <small class="float-right"><button type="button"   data-toggle="modal" class="btn btn-secondary"
                                                                           data-target="#fullHeightModalRight"> Thay đổi người giúp việc
                                            </button></small>
                                    @endif
                                </h4>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>Người thuê</b>
                                <address>
                                    <ins><i>{{$post->customer->name}}</i></ins><br>
                                    @if($post->ward_id && $post->district_id)
                                        <span>Địa chỉ : {{$post->ward->name}} , {{$post->district->name}} </span><br/>
                                    @endif
                                    Phone: {{$post->customer->phone}}<br>
                                    Email: {{$post->customer->email}}
                                </address>
                            </div>
                            <div class="col-sm-4 invoice-col">
                              <b>Công việc</b>   <br>
                                <ins><i>{{$post->category->name}}</i></ins><br>
                                @if($post->attributes)
                                    @foreach ($post->attributes as $attribute)
                                    @if($attribute->type=="select"||$attribute->type=="radio")
                                        {{$attribute->name}} :  {{json_decode($attribute['options'],true)[json_decode($attribute->pivot->value,true)]}}
                                        <br/>
                                    @elseif($attribute->type=="checkbox")
                                            {{$attribute->name}} :
                                        @foreach(json_decode($attribute->pivot->value,true) as $value)
                                                {{json_decode($attribute['options'],true)[$value]}}
                                            @endforeach<br/>
                                    @elseif($attribute->type=='input'||$attribute->type=='textarea')
                                            {{$attribute->name}} :  {{json_decode($attribute->pivot->value,true)}}<br/>
                                    @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-sm-4 invoice-col">

                                    @if($post->employee_id)
                                        <b>Người giúp việc</b>
                                        <div id="employee">
                                            <address>
                                                <ins><i>{{$post->employee->name}}</i></ins><br>
                                                @if($post->employee->ward_id && $post->employee->district_id)
                                                    <span>Địa chỉ : {{$post->employee->ward->name}} , {{$post->employee->district->name}} </span>
                                                    <br/>
                                                @endif
                                                Phone: {{$post->employee->phone}}<br>
                                                Email: {{$post->employee->email}}
                                            </address>
                                        </div>
                                    @else
                                        <b>Người giúp việc</b>
                                        <div id="employee"></div>
                                    @endif
                                </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <!-- /.row -->
                        <form action="{{route('manager.post.updateStatus',['id'=>$post->id])}}" method="post">
                            @csrf
                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Chi tiết công việc:</p>

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    {!! $post->description !!}
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            @if($post->status==1||$post->status==2||$post->status==3)
                                            <th>Chuyển trạng thái</th>
                                            <td>

                                                    <select name="statusPost" style="width: 150px" id="changeStatusPost" >
                                                        @foreach(managerPostStatus() as $status)
                                                            <option data-statusName="{{$status['name']}}" value="{{$status['value']}}" {{$status['value']==3?'disabled':''}} {{$status['value']==$post->status?"selected='selected'":''}} >{{$status['name']}}</option>
                                                        @endforeach
                                                    </select>
                                            </td>
                                                @else
                                                <th>Trạng thái công việc</th>
                                                <td> {{getStatus($post->status)}}
                                                    </td>
                                                @endif

                                        </tr>
                                        <tr>
                                            <th>Địa chỉ :
                                            </th>
                                            <td>
                                                @if($post->addressDetails)
                                                    {{$post->addressDetails}}
                                                @endif
                                                @if($post->district_id),
                                                    {{$post->ward->district->name}}
                                                @endif
                                                @if($post->ward_id),
                                                {{$post->ward->name}}
                                                @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Thời gian thuê :
                                               </th>
                                            <td> @if($post->time)<span>{{$post->time}}</span> @endif</td>
                                        </tr>
                                        <tr>
                                            <th style="width:50%">Giá:</th>
                                            <td>$ {{$post->price}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <!-- this row will not appear when printing -->
                        <input hidden name="status" value="{{$post->status}}">
                        <div class="row no-print">
                            <div class="col-12">
                                @if($post->status==Post::ChoDuyet||Post::DaDuyet||Post::TimDuocNGV)

                                <button type="submit" onclick=" return confirm('Cập nhật ')" class="btn btn-info float-left" ><i class="fas fa-sync"></i>
                                    Cập nhật
                                </button>
                                @endif
                                @if($post->status!=Post::DaHuy)
                                <button type="button" id="delete" class="btn btn-danger float-right" style="margin-right: 5px;">
                                    <i class="far fa-trash-alt"></i> Huỷ
                                </button>
                                @endif
                                <!-- Button trigger modal -->


                                <!-- Full Height Modal Right -->
                                <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel"
                                     aria-hidden="true">

                                    <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                                    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">


                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="form-group filterData">
                                                    @if(Request::get('district'))
                                                        <input id="districtPost" value="{{Request::get('district')}}" hidden>
                                                    @endif
                                                    <select class="form-control" name="district" id="districtFind">
                                                        <option value="">Quận huyện</option>
                                                        @foreach($address as $a)
                                                            <option {{Request::get('district')==$a->maqh?"selected='selected":''}} value="{{$a->maqh}}">{{$a->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group filterData ">
                                                    <select class="form-control" name="statusFilter" id="status">
                                                        <option {{Request::get('statusFilter')==null ?"selected='selected'":'' }} value="">Trạng
                                                            thái
                                                        </option>
                                                        @foreach(employeeStatus() as $status)
                                                            <option {{Request::get('statusFilter')==$status['value'] &&Request::get('status')!=null ?"selected='selected'":''}}  value="{{$status['value']}}">{{$status['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="filterData" style="width: 45%">
                                                    <input value="{{Request::get('search')}}" id="findEmployee"
                                                           placeholder="Tìm kiếm" type="text" class="form-control"
                                                           name="search">
                                                </div>
                                                <span class="input-group-append">
                                                    <input value="{{$post->id}}" id="post_id" hidden>
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($employees as $employee)
                                                        <tr>
                                                            <td><input type="radio" name="employee_id" data-employee="{{$employee}}"
                                                                       value="{{$employee->id}}"></td>
                                                            @if($employee->avatar)
                                                                <td><img style="width: 40px;height: 40px" src="{{asset($employee->avatar)}}"></td>
                                                            @else
                                                                <td><img src="{{asset('images/avt.jpeg')}}"
                                                                         style="width:40px;height: 40px"></td>
                                                            @endif
                                                            <td>{{ $employee->name}}</td>
                                                            <td>{{$employee->email}}</td>
                                                            <td>{{$employee->phone}}</td>
                                                            <td>
                                                                @if($employee->ward_id && $employee->district_id)
                                                                    {{$employee->ward->name}} , {{$employee->district->name}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-primary" onclick="saveData()" id="save" data-dismiss="modal">Lưu
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Full Height Modal Right -->
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        $('#delete').click(function (){
            var answer = confirm("Xoá bài đăng")
            if (answer){
                alert("bi bi");
                var token = $("input[name='_token']").val();
                var id = $("#post_id").val()
                var url='{!! route('manager.post.updateStatus',[':id']) !!}';
                url=url.replace(':id',id)
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        status: {{Post::DaHuy}},
                        _token: token,
                    },
                    success :function (data){
                        location.reload()
                    }
                })
            }
            else{

            }

        })

        function saveData(){
           $('#changeStatusPost').attr("disabled",true)
           var html =''
           $('#employee').html('')
           var x = $('input[name="employee_id"]:checked').data('employee');
           var y= JSON.parse(document.querySelector('input[name="employee_id"]').getAttribute('data-employee'))
           console.log(y)
           html+=    "<address>"
           html+=    "<ins><i>"+x.name+"</i></ins><br>"
           html+=    "Phone: "+x.phone+"<br>"
           html+= "Email: "+x.email+""
           html+= "</address>"
           $('#employee').html(html)
       }
        function chooseEmployee() {
            var id=$('#post_id').val();
                var district =$('#districtFind').val()
                var status =$('#status').val()
                var search =$('#findEmployee').val()
            var url = "{!! route('manager.post.details',[':id']) !!}";
            url = url.replace(':id', id);
            url = url+'?district='+district +'&status='+status +'&search='+search ;
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
            $("#employee").load(" #employee > * ");
        }
        function refresh() {
            var id=$('#post_id').val();
            var url = "{!! route('manager.post.details',[':id']) !!}";
            url = url.replace(':id', id);
            window.history.pushState({}, '', url);
            $("#fullHeightModalRight").load(" #fullHeightModalRight > * ");
        }
    </script>
@endsection
