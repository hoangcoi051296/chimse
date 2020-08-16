@extends('manager.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sửa người giúp việc</h1>

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
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
            <form action="{{route('manager.employee.update',['id'=>$helper->id])}}" method="post" >
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
                                    <label for="inputName">Tên </label>
                                    <input type="text" name="name" value="{{$helper->name}}" id="inputName" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input name="email" type="email" value="{{$helper->email}}"  class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Số điện thoại</label>
                                    <input name="phone" value="{{$helper->phone}}" type="text"   class="form-control" >
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Quận huyện</label>
                                    <select  class="form-control custom-select" name="district">
                                        <option selected="" disabled="">Hà Nội </option>
                                        @foreach($address as $a)
                                            <option value="{{$a->maqh}}"}} {{$helper->Ward->District->maqh==$a->maqh?"selected='selected'":''}} >{{$a->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Xã phường</label>
                                    <select  class="form-control custom-select" name="ward">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Mật khẩu </label>
                                    <input type="password" name="password" id="inputClientCompany" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputProjectLeader">Nhập lại mật khẩu</label>
                                    <input type="password" name="password_confirmation" id="inputProjectLeader" class="form-control">
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
                <div class="row " style="margin-bottom: 40px" >
                    <div class="col-12">

                        <button type="submit"  class="btn btn-success float-left"> Click zoo</button>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript">
        var url = "{{ url('manager/post/showWard') }}";
        $("select[name='district']").change(function(){
            var address = $(this).val();
            var token = $("input[name='_token']").val();
            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    address: address,
                    _token: token,
                },
                success: function(data) {
                    console.log(data)
                    $("select[name='ward']").html('');
                    $.each(data, function(key, value){
                        console.log(value)
                        $("select[name='ward']").append(
                            "<option value=" + value.xaid + ">" + value.name + "</option>"
                        );
                    });
                }
            });
        });
    </script>
@endsection
