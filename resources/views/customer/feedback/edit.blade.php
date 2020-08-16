@extends('customer.layout.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Sửa Feedback</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('customer.feedback.index')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('customer.feedback.index')}}">Danh sách</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="">
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
                                <div class="form-group">
                                    <label for="inputName">Comment</label>
                                    <input type="text" name="comment" id="inputName" value="{{$feedback->comment}}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Rating</label>
                                    <input type="text" name="rating" id="inputName" value="{{$feedback->rating}}"
                                           class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                <div class="row " style="margin-bottom: 40px">
                    <div class="col-12">
                        <input type="submit" value="Update" class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
