<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center pt-5"
        href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('images/logo-nicewone-landscape-transparant.png') }}" alt="logo" class="img-fluid"
                width="130">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0 mt-4">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Environment
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @can('view', App\User::class)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <i class="fas fa-fw fa-book"></i>
                <span>Config</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('admin.user.data') }}">User</a>
                    <a class="collapse-item" href="{{ route('admin.status.data') }}">Status</a>
                </div>
            </div>
        </li>
    @endcan

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('front.data.wish', Auth::user()->slug) }}"><b>Frontend
                        Web</b></a>
                <a class="collapse-item" href="{{ route('admin.data.event') }}">Event</a>
                <a class="collapse-item" href="{{ route('admin.gallery.head') }}">Head Gallery</a>
                <a class="collapse-item" href="{{ route('admin.story.data') }}">Story</a>
                <a class="collapse-item" href="{{ route('admin.gallery.data') }}">Gallery</a>
                <a class="collapse-item" href="{{ route('admin.contactinfo.data') }}">Contact Information</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fas fa-fw fa-book"></i>
            <span>Friends Wishes</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.data.wish') }}">Message</a>
                <a class="collapse-item" href="{{ route('admin.data.attendance') }}">RSVP</a>
                <a class="collapse-item" href="{{ route('admin.contact.data') }}">Contact</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
