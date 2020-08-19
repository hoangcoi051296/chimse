@if (session()->has('error'))
    <div class="alert alert-danger " style="width: 200px;height: 40px">
            {{session('error')}}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success" style="width: 200px;height: 40px">
            {{session('success')}}
    </div>
@endif
