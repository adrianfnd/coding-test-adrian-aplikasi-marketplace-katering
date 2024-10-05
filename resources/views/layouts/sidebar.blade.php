<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Marketplace Katering</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            @if (auth()->user()->role->nama_role == 'Merchant')
                <li class="nav-item">
                    <a href="{{ route('menu') }}" class="nav-link align-middle px-0 text-white">
                        <i class="bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Menu</span>
                    </a>
                </li>
            @elseif (auth()->user()->role->nama_role == 'Customer')
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link align-middle px-0 text-white">
                        <i class="bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Menu</span>
                    </a>
                </li>
            @endif
            {{-- <li>
                <a href="#" class="nav-link px-0 align-middle text-white">
                    <i class="bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                </a>
            </li> --}}
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                @if (auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="{{ auth()->user()->name }}" width="30" height="30" class="rounded-circle">
                @else
                    <img src="https://via.placeholder.com/30" alt="Default Image" width="30" height="30" class="rounded-circle">
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