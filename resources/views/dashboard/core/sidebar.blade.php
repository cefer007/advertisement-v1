<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

            <div class="sidebar-brand-text mx-3"> Advertisement</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pages
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"--}}
{{--               aria-expanded="true" aria-controls="collapseTwo">--}}
{{--                <i class="fas fa-fw fa-cog"></i>--}}
{{--                <span>Components</span>--}}
{{--            </a>--}}
{{--            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
{{--                <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                    <h6 class="collapse-header">Custom Components:</h6>--}}
{{--                    <a class="collapse-item" href="buttons.html">Buttons</a>--}}
{{--                    <a class="collapse-item" href="cards.html">Cards</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </li>--}}

        <!-- Nav Item - Pages Collapse Menu -->

        <!-- Nav Item - Charts -->

        <li class="nav-item @if(request()->segment(2) == "home") active @endif">
            <a class="nav-link" href="{{route('dashboard.home')}}">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Home</span></a>
        </li>

        <li class="nav-item @if(request()->segment(2) == "site-user") active @endif">
            <a class="nav-link" href="{{route('dashboard.site-user.index')}}">
                <i class="fas fa-fw fa-user"></i>
                <span>Site user</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item @if(request()->segment(2) == "car") active @endif">
            <a class="nav-link" href="{{route('dashboard.car.index')}}">
                <i class="fas fa-fw fa-car"></i>
                <span>Car</span></a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item @if(request()->segment(2) == "car-model") active @endif">
            <a class="nav-link" href="{{route('dashboard.car-model.index')}}">
                <i class="fas fa-fw fa-car-side"></i>
                <span>Car Models</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

