
@extends('customer.layout.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Danh sách review</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{url('/')}}"></a>Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form class="ml-3" action="" method="GET">
                        <div class="card">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" placeholder="Search" aria-label="Search"
                                       name="search" id="search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" id="searchPost" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Customer</th>
                                    <th>Eployee</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th style="width: 113px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($feedbacks))
                                    @foreach($feedbacks as $key => $fb)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{ ($fb->customer) ? $fb->customer->name :'' }}</td>
                                            <td>{{($fb->employee) ? $fb->employee->name :''}}</td>
                                            <td>{!!$fb->comment!!}</td>
                                            <td>{{$fb->rating}}</td>
                                            <td>
                                                <a href="{{ route('customer.feedback.edit',['id' => $fb->id])}}"
                                                   class="btn btn-primary btn-xsmax"><i class="fa fa-edit"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(()=>{
            $('#searchPost').click(() => {
                console.log("ok");
                $.ajax({
                    url: "{{ route('customer.post.index')}}",
    method: 'get',
    data: $('#search').val(),
    success: function(response){
    console.log(response);
    }});
    });
    });
    </script> --}}
@endsection
