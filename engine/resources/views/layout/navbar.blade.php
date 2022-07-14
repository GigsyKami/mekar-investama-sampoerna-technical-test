<header
    class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#?" class="nav-link px-2 link-dark" id="history">History</a></li>
        <li><a href="#?" class="nav-link px-2 link-dark" id="top-up">Top Up</a></li>
        <li><a href="#?" class="nav-link px-2 link-dark" id="transfer">Transfer</a></li>
    </ul>

    <div class="col-md-3 text-end">
        @auth
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name ?? '-' }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" id="logout" href="#?">Logout</a></li>
                </ul>
            </div>
        @else
            <button type="button" class="btn btn-outline-primary me-2" id="login">Login</button>
            <button type="button" class="btn btn-primary" id="register">Sign-up</button>
        @endauth
    </div>
</header>
