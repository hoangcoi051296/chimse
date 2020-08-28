@extends('customer.layout.layout')
@section('style')

@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Đánh giá người giúp việc</h1>
                </div><!-- /.col --><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{route('customer.post.feedback')}}">
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
                                    <label for="inputName">Rating</label>
                                    <h4><div id="review" ></div></h4>
                                    <input hidden type="text" name="rating" readonly id="starsInput" class="form-control form-control-sm">
                                </div>
                                <div class="form-group">
                                    <label for="inputName">Đánh giá</label>
                                    <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                                    @if($errors->has('comment'))
                                        <div class="messages-error">
                                            {{$errors->first('comment')}}
                                        </div>
                                    @endif
                                </div>
                                <input name="post_id" value="{{$post->id}}" hidden>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row " style="margin-bottom: 40px" >
                    <div class="col-12">
                        <input type="submit" value="Tạo " class="btn btn-success float-left">
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection
@section('script')
    <script type="text/javascript" src="{{asset("js/rating.js")}}"></script>
    <script>
        tinymce.init({
            selector: '#comment'
        });
        $("#review").rating({
            "value":5 ,
            "click": function (e) {
                console.log(e);
                $("#starsInput").val(e.stars);
            }
        });
    </script>
@endsection
