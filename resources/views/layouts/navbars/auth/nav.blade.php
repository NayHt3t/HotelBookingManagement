<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">{{ str_replace('-', ' ', Request::path()) }}</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6>

        </nav>

        <div class="nav-item d-flex align-self-end ml-4">

            <h4>Welcome</h4>
            <h4 class="mx-4"><?php echo ucfirst(auth()->user()->role); ?></h4>
        </div>

        <div class="ms-md-3 pe-md-3 d-flex align-items-center">



            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">

                <ul class="navbar-nav  justify-content-end">

                    <li class="nav-item px-3 d-flex align-items-center">
                        <div>
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <!-- <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i> -->
                                <i class="fa fa-bell cursor-pointer fixed-plugin-button-nav"></i>
                                @if ($unseenCount > 0)
                                <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $unseenCount }}
                                </span>
                                @endif 
                            </a>
                        </div>

                    </li>

                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ url('/logout')}}" class="nav-link text-body font-weight-bold px-0">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</nav>
<!-- End Navbar -->