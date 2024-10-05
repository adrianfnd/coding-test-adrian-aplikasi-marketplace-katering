<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-3 text-white min-vh-100">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">Marketplace Katering</span>
        </a>
        <hr class="bg-light my-4 w-100">
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item">
                <a href="{{ route('menu') }}" class="nav-link align-middle px-0 text-white">
                    <i class="bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Menu</span>
                </a>
            </li>
            <li>
                <a href="#" class="nav-link px-0 align-middle text-white">
                    <i class="bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                </a>
            </li>
        </ul>
        <hr class="bg-light my-4 w-100">
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                @if (auth()->user()->profile_image)
                        <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}" width="40" height="40" class="rounded-circle me-3">
                @else
                    <img src="https://via.placeholder.com/40" alt="Default Image" width="40" height="40" class="rounded-circle me-3">
                @endif
                <span class="d-none d-sm-inline mx-1">{{ Auth::user()->nama_perusahaan }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>