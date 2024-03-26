<div class="top-bar">
    <div class="-intro-x breadcrumb me-auto d-none d-sm-flex"> <a href="{{ route('dashboard') }}">Application </a> <i class="fa fa-chevron-right breadcrumb__icon"></i> <a href="#" class="breadcrumb--active">{{ $breadcrumb ?? 'Dashboard' }} </a> </div>

    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-pill overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-bs-toggle="dropdown">
            <img alt="Rubick Tailwind HTML Admin Template" src="{{ asset('admin/dist/images/user-icon.png') }}" />
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-theme-26 dark-bg-dark-6 text-white">
                <li class="p-2">
                    <div class="fw-medium text-white">{{ Auth::user()->name }} </div>
                    <div class="fs-xs text-theme-28 mt-0.5 dark-text-gray-600">{{ Auth::user()->roles()->first()?->name }}</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3" />
                </li>
                <li>
                    <a href="{{ route('show-change-password') }}" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover"> <i class="fas fa-lock-open w-4 h-4 me-2"></i> Reset Password </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-theme-27 dark-border-dark-3" />
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item text-white bg-theme-1-hover dark-bg-dark-3-hover">
                        <i class="fas fa-arrow-right-from-bracket w-4 h-4 me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
