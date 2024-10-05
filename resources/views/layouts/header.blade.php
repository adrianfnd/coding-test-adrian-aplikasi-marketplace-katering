<header class="mb-3">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="container-fluid">
            @if (auth()->user()->role->nama_role == 'Customer')
                <form class="d-flex ms-auto">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            @endif
        </div>
    </nav>
</header>