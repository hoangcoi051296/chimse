
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Update User Status Using Toggle Button Example - codechief.org </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</head>
<body>
<div class="container">
    <h1>Laravel Update User Status Using Toggle Button Example </h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            {{--<th>Name</th>--}}
            {{--<th>Email</th>--}}
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                {{--<td>{{ $post->name }}</td>--}}
                {{--<td>{{ $post->email }}</td>--}}
                <td>
                    <input data-id="{{$post->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $post->status ? 'checked' : '' }}>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var post_id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/changeStatus',
                data: {'status': status, 'post_id': post_id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
    })
</script>
</html>