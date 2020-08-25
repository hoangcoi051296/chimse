@if (session()->has('error'))
    <div class="alert alert-danger "  style="width: 210px;height: 49px">
            {{session('error')}}
    </div>
@endif
@if (session()->has('success'))
    <div class="alert alert-success" style="width: 210px;height: 49px">
            {{session('success')}}
    </div>
@endif
