<header>
    <div class="container-fluid px-xl-5 py-2 d-md-flex align-items-center justify-content-between">

        <div class="headerLeft d-flex p-1 align-items-center">
            <img src="{{ asset('frontend/img/kdmc_logo.png') }}" class="img-fluid" width="50" alt="Government of Maharashtra" />
            <div class="logo px-2">
                <a href="{{ route('frontend.home') }}">
                    कल्याण डोंबिवली महानगरपालिका  <br />
                </a>
            </div>
        </div>
        <nav class="navbar navbar-expand-xl">
            <div class="container-fluid">
                <button class="navbar-toggler bg-theme" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    Menu <i class="bi bi-caret-down-fill"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div id="HeaderMain1_menu_smoothmenu1">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                            <li class="nav-item">
                                <a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            @guest()
                                <li>
                                    <a class="btn btn-dark text-white" href="{{ route('login') }}">Login</a>
                                </li>
                                <li>
                                    <a class="btn btn-dark text-white" href="{{ route('register') }}">Register</a>
                                </li>
                            @endguest
                            @auth()
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
