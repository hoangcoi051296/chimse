@extends('employee.layout.layout')
@section('content')
<?php
    use App\Models\Post;
?>
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
                        <h5>Trạng thái : {{getPostStatus($post->status)}}</h5>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                                </h4>


                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-6 invoice-col">
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
                                                {{json_decode($attribute['options'],true)[$value]}} .
                                            @endforeach<br/>
                                        @elseif($attribute->type=='input'||$attribute->type=='textarea')
                                            {{$attribute->name}} :  {{json_decode($attribute->pivot->value,true)}}<br/>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <!-- /.row -->
                        <form action="{{route('employee.post.update',['id'=>$post->id])}}" method="post">
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

                                            </tr>
                                            <tr>
                                                <th>Thời gian bắt đầu :
                                                </th>
                                                <td> @if($post->time_start)<span>{{$post->time_start}} đến {{$post->time_end}}</span> @endif</td>
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

                            <div class="row no-print">
                                <div class="col-12">
                                    @if($post->status==Post::TimDuocNGV)
                                        <button type="button" data-status={{$post->status}} id="changeStatus" class="btn btn-info float-left" ><i class="fas fa-sync"></i>
                                            Xác nhận công việc
                                        </button>
                                    @elseif($post->status==Post::NGVXacNhanCV)
                                        <button type="button" data-status={{$post->status}}  id="changeStatus" class="btn btn-info float-left" ><i class="fas fa-sync"></i>
                                            Bắt đầu công việc
                                        </button>
                                    @elseif($post->status==Post::NGVBatDau)
                                        <button type="button" data-status={{$post->status}} id="changeStatus" class="btn btn-info float-left" ><i class="fas fa-sync"></i>
                                           Kết thúc công việc
                                        </button>
                                    @endif
                                    @if($post->status==Post::TimDuocNGV)
                                        <button type="button" id="delete" class="btn btn-danger float-right" style="margin-right: 5px;">
                                            <i class="far fa-trash-alt"></i> Huỷ
                                        </button>
                                @endif
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
            var answer = confirm("Từ chối công việc")
            if (answer){
                alert("bi bi");
                var token = $("input[name='_token']").val();
                var id = $("#postID").val()
                var url='{!! route('employee.post.update',[':id']) !!}';
                url=url.replace(':id',id)
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        status: {{Post::DaDuyet}},
                        _token: token,
                    },
                    success :function (data){
                        var loc = "{{route('employee.post.index')}}";
                        window.location = loc;
                    }
                })
            }
            else{

            }
        })

        $('#changeStatus').click(function (){
            var answer = confirm("Chuyển trạng thái")
            if (answer){
                var token = $("input[name='_token']").val();
                var id = $("#postID").val()
                var status= $(this).data('status')
                var statusPost
                if (status=={{Post::TimDuocNGV}}){
                    statusPost={{Post::NGVXacNhanCV}}
                }
                if (status=={{Post::NGVXacNhanCV}}){
                    statusPost={{Post::NGVBatDau}}
                }
                if (status=={{Post::NGVBatDau}}){
                    statusPost={{Post::NGVKetThuc}}
                }
                var url='{!! route('employee.post.update',[':id']) !!}';
                url=url.replace(':id',id)
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        status: statusPost,
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
    </script>
@endsection
