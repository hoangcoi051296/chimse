@extends('manager.layout.layout')
@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Chi tiết công việc</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Bài đăng : #{{$post->id}}</h5>
                        </div>


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> AdminLTE, Inc.
                                        <small class="float-right">Date: {{now()}}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                   Người thuê
                                    <address>
                                        <strong>{{$post->customer->name}}</strong><br>
                                        @if($post->ward_id && $post->district_id)
                                            <span>Địa chỉ : {{$post->ward->name}} , {{$post->district->name}} </span><br/>
                                        @endif
                                        Phone: {{$post->customer->phone}}<br>
                                        Email: {{$post->customer->email}}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Danh mục <br>
                                    <strong>{{$post->category->name}}</strong><br>
                                    @if($post->attributes)
                                        @foreach( json_decode($post->attributes,true) as $key => $attribute )
                                                @if(getAttributes($key)->type=="select"||getAttributes($key)->type=="radio")
                                                <b>{{getAttributes($key)->name}}</b> : {{json_decode(getAttributes($key)->options,true)[$attribute]}}<br/>
                                                @elseif(getAttributes($key)->type=="textarea"||getAttributes($key)->type=="input")
                                                <b>{{getAttributes($key)->name}}</b> : {{$attribute}}<br/>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- /.col -->
                                @if($post->employee_id)
                                <div class="col-sm-4 invoice-col">
                                    Người giúp việc
                                    <address>
                                        <strong>{{$post->employee->name}}</strong><br>
                                        @if($post->employee->ward_id && $post->employee->district_id)
                                            <span>Địa chỉ : {{$post->employee->ward->name}} , {{$post->employee->district->name}} </span><br/>
                                        @endif
                                        Phone: {{$post->employee->phone}}<br>
                                        Email: {{$post->employee->email}}
                                    </address>
                                </div>
                            @endif
                                <!-- /.col -->
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <!-- /.row -->

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
                                    <p class="lead">Amount Due 2/22/2014</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <th>Thời gian thuê</th>
                                                <td></td>
                                            </tr><tr>
                                                <th style="width:50%">Giá:</th>
                                                <td>$ {{$post->price}}</td>
                                            </tr>
                                            <tr>
                                                <th>Trạng thái công việc</th>
                                                <td>{{getStatus($post->status)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td></td>
                                            </tr>
                                            </tbody></table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                                        <i class="far fa-trash-alt"></i> Huỷ
                                    </button>
                                    <button type="button" class="btn btn-success float-right"><i class="fas fa-exchange-alt"></i> Thay đổi trạng thái
                                    </button>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fullHeightModalRight">
                                        Launch demo modal
                                    </button>

                                    <!-- Full Height Modal Right -->
                                    <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                         aria-hidden="true">

                                        <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                                        <div class="modal-dialog modal-full-height modal-right" role="document">


                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Full Height Modal Right -->
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
@endsection
