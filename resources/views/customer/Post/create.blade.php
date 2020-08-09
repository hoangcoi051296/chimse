@extends('customer.layout.layout')
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tạo bài đăng</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('customer.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('customer.index')}}"></a>Danh sách</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('customer.post.store')}}">
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
                                    <label for="inputName">Title</label>
                                    <input type="text" name="title" id="inputName" class="form-control">
                                    @if($errors->has('title'))
                                        {{$errors->first('title')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Description</label>
                                    <input type="text" name="description" id="inputName" class="form-control"
                                           style="color: red">
                                    @if($errors->has('description'))
                                        {{$errors->first('description')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Province</label>
                                    <select class="form-control custom-select" id="province" name="province_id">
                                        <option selected>Province</option>
                                        @foreach($provinces as $p)
                                            <option value="{{$p->matp}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('province'))
                                        {{$errors->first('province')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">District</label>
                                    <select class="form-control custom-select" id="district" name="district_id"
                                            type="text">
                                        <option selected="" disabled="">District</option>

                                    </select>
                                    @if($errors->has('province'))
                                        {{$errors->first('province')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputStatus">Commune</label>
                                    <select class="form-control custom-select" id="commune" name="commune_id"
                                            type="text">
                                        <option selected="" disabled="">Commune</option>

                                    </select>
                                    @if($errors->has('province'))
                                        {{$errors->first('province')}}
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="inputName">Price</label>
                                    <input type="text" name="price" id="inputName" class="form-control">
                                    @if($errors->has('price'))
                                        {{$errors->first('price')}}
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">Chọn loại</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('category'))
                                        {{$errors->first('category')}}
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Create post" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
    <script>
        $('#province').change(() => {
            $('#commune').html('');
            let province_id = $('#province').val();
            $.ajax({
                url: "{{ route('district.by.province') }}",
                type: "GET",
                data: {id: province_id},
                success: function (response) {
                    if (!response.errors) {
                        let list_district;
                        response.data.forEach(district => {
                            list_district += `<option value="${district.maqh}">${district.name}</option>`;
                        });
                        $('#district').html(list_district);
                        $('#district').change(() => {
                            let district_id = $('#district').val();
                            console.log('ád');
                            $.ajax({
                                url: "{{ route('commune.by.district') }}",
                                type: "GET",
                                data: {id: district_id},
                                success: function (response) {
                                    console.log(response);
                                    if (!response.errors) {
                                        let list_commune;
                                        response.data.forEach(commune => {
                                            list_commune += `<option value="${commune.xaid}">${commune.name}</option>`;
                                        });
                                        $('#commune').html(list_commune);
                                    }
                                }
                            });
                        })
                    }
                }
            });
        })
    </script>
@endsection
