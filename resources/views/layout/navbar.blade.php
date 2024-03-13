<div class="adminx-container">
    <nav class="navbar navbar-expand justify-content-between fixed-top">
        <a class="navbar-brand mb-0 h1 d-none d-md-block" href="{{ route('attendance') }}">
            <img src="{{ asset('assets') }}/img/logo.png" class="navbar-brand-image d-inline-block align-top mr-2"
                alt="">
            Absensi
        </a>

        <form class="form-inline form-quicksearch d-none d-md-block mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-icon">
                        <i data-feather="search"></i>
                    </div>
                </div>
                <input type="text" class="form-control" id="search" placeholder="Type to search...">
            </div>
        </form>

        <div class="d-flex flex-1 d-block d-md-none">
            <a href="#" class="sidebar-toggle ml-3">
                <i data-feather="menu"></i>
            </a>
        </div>

        <ul class="navbar-nav d-flex justify-content-end mr-2">
            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                    <img src="{{ asset('storage/photo/' . Auth::user()->photo) }}" class="d-inline-block align-top"
                        alt="">
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <button type="submit" class="dropdown-item text-danger">Sign out</button>
                    </div>

                </form>
            </li>
        </ul>
    </nav>
