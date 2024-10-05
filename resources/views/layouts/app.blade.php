<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Marketplace Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                height: 100vh;
                z-index: 999;
                transition: all 0.3s;
            }
            .sidebar.active {
                left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!-- Sidebar -->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Marketplace Katering</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{ route('menu') }}" class="nav-link align-middle px-0 text-white">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Menu</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0 align-middle text-white">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Orders</span>
                            </a>
                        </li>
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
            <!-- Main Content -->
            <div class="col py-3">
                <header class="mb-3">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="#">Dashboard</a>
                            <button class="btn btn-dark d-md-none me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="bi bi-list"></i>
                            </button>
                            @if (auth()->user()->role->nama_role == 'Customer')
                                <form class="d-flex ms-auto mt-3 mb-2">
                                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">Search</button>
                                </form>
                            @endif
                        </div>
                    </nav>
                </header>
                
                <!-- Main content area -->
                <main>
                    @yield('content')
                </main>
                
                <!-- Footer -->
                <footer class="footer mt-auto py-3">
                    <div class="container text-center">
                        <span class="text-muted">Copyright © 2024 for test purpose</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebarToggle = document.querySelector('[data-bs-toggle="collapse"]');
            var sidebar = document.querySelector('.sidebar');

            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        });
    </script>
</body>
</html>