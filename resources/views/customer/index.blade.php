@extends('customer.layout')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách customer</h2>
                <div style="display: flex; display: flex;justify-content: space-between;">
                    <form action="" method="get">
                        <div class="form-group">
                            <input type="text" name="keyword">
                            <button type="submit" style="padding: 4px;"><i class="fa fa-search"></i></button>
                        </div>

                    </form>
                    <div class="pull-right">
                        <a class="btn btn-success" href="">Thêm customer</a>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-keytable"
                                   class="table table-striped table-bordered dataTable no-footer" role="grid"
                                   aria-describedby="datatable-keytable_info" style="position: relative;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 180px;">Title
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 180px;">Status
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 295px;">description
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 180px;">price
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 180px;">Address
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="datatable-keytable" rowspan="1"
                                        colspan="1" aria-label="Position: activate to sort column ascending"
                                        style="width: 295px;">Action
                                    </th>

                                </tr>
                                </thead>

                                {{--<tbody>--}}
                                {{--@foreach($film as $film)--}}
                                    {{--<tr role="row" class="odd">--}}
                                        {{--<td class="sorting_1">{{$film->name}}</td>--}}
                                        {{--<td>{!!substr($film->description, 0, 255)!!}...</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="admin/view/{{$film->id}}">View | </a>--}}
                                            {{--<a href="admin/edit/{{$film->id}}">Edit | </a>--}}
                                            {{--<a href="admin/delete/{{$film->id}}"--}}
                                               {{--onclick="return confirm('Bạn thích xóa không?')"> Delete </a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                                {{--</tbody>--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
