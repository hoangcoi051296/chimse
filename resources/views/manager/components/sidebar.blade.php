@php
    $sideManager=sidebarManager();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" id="main-sidebar">
    <!-- Brand Logo -->
    <a href="{{route('manager.index')}}" class="brand-link">
        <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(Auth::guard('manager')->user()->avatar)
                    <img src="{{asset(Auth::guard('manager')->user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{asset("images/avt.jpeg")}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            @if(Auth::guard('manager')->check())
            <div class="info">
                <a href="#" class="d-block">{{Auth::guard('manager')->user()->name}}</a>
            </div>
            @endif
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Quản lý</li>
                @foreach($sideManager['manager'] as $sidebar)

                    <li class="nav-item @foreach($sidebar['child'] as $child){{$child['route']==URL::current()||$child['route']==getUrlEdit(URL::current())?'menu-open':'menu-close'}} @endforeach ">
                        <a href="#" class="nav-link @foreach($sidebar['child'] as $child){{$child['route']==URL::current()||$child['route']==getUrlEdit(URL::current())?'active':''}} @endforeach">
                            <i class="{{$sidebar['icon']}}"></i>
                            <p>
                               {{$sidebar['name']}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @if($sidebar['child'])
                            <ul class="nav nav-treeview">
                                @foreach($sidebar['child'] as $child)
                                    <li class="nav-item">
                                        <a href="{{$child['route']}}" class="nav-link {{$child['route']==URL::current()?'active':''}}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{$child['name']}}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @endif

                    </li>
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
