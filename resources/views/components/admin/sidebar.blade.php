<nav class="side-nav">
    <a href="{{ route('dashboard') }}" class="intro-x d-flex align-items-center ps-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('admin/dist/images/logo.svg') }}" />
        <span class="d-none d-xl-block text-white fs-lg ms-3"><span class="fw-medium">KDMC </span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>

        <li>
            <a href="{{ route('dashboard') }}" class="side-menu {{ request()->routeIs('dashboard') ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i class="fas fa-house"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>



        @canany(['wards.view', 'locations.view', 'banners.view', 'police_stations.view', 'documents.view'])
            <li>
                <a href="javascript:;" class="side-menu {{ request()->routeIs('wards.index') || request()->routeIs('locations.index') || request()->routeIs('banners.index') || request()->routeIs('police_stations.index') || request()->routeIs('documents.index') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-list-ul"></i> </div>
                    <div class="side-menu__title">
                        Masters
                        <div class="side-menu__sub-icon"> <i class="fas fa-chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="{{ request()->routeIs('wards.index') || request()->routeIs('locations.index') || request()->routeIs('banners.index') || request()->routeIs('police_stations.index') || request()->routeIs('documents.index') ? 'side-menu__sub-open' : '' }}">
                    @can('wards.view')
                        <li>
                            <a href="{{ route('wards.index') }}" class="side-menu {{ request()->routeIs('wards.index') ? 'side-menu--active side-menu--open' : '' }}">
                                <div class="side-menu__icon"> <i class="fas fa-vihara"></i> </div>
                                <div class="side-menu__title"> Ward </div>
                            </a>
                        </li>
                    @endcan
                    {{-- @can('locations.view')
                        <li>
                            <a href="{{ route('locations.index') }}" class="side-menu {{ request()->routeIs('locations.index') ? 'side-menu--active side-menu--open' : '' }}">
                                <div class="side-menu__icon"> <i class="fa fa-map-marker"></i> </div>
                                <div class="side-menu__title"> Location </div>
                            </a>
                        </li>
                    @endcan --}}
                    @can('banners.view')
                        <li>
                            <a href="{{ route('banners.index') }}" class="side-menu {{ request()->routeIs('banners.index') ? 'side-menu--active side-menu--open' : '' }}">
                                <div class="side-menu__icon"> <i class="fa fa-credit-card"></i></div>
                                <div class="side-menu__title"> Banner </div>
                            </a>
                        </li>
                    @endcan
                    @can('police_stations.view')
                        <li>
                            <a href="{{ route('police_stations.index') }}" class="side-menu {{ request()->routeIs('police_stations.index') ? 'side-menu--active side-menu--open' : '' }}">
                                <div class="side-menu__icon"> <i class="fas fa-building-shield" aria-hidden="true"></i></div>
                                <div class="side-menu__title"> Police Station </div>
                            </a>
                        </li>
                    @endcan
                    @can('documents.view')
                        <li>
                            <a href="{{ route('documents.index') }}" class="side-menu {{ request()->routeIs('documents.index') ? 'side-menu--active side-menu--open' : '' }}">
                                <div class="side-menu__icon"> <i class="fa fa-credit-card"></i></div>
                                <div class="side-menu__title"> Document </div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('users.view')
            <li>
                <a href="{{ route('users.index') }}" class="side-menu {{ request()->routeIs('users.index') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> User Registration </div>
                </a>
            </li>
        @endcan

        {{-- @canany(['police-request.approved']) --}}


            <li>
                <a href="{{ route('permission-requests',0) }}" class="side-menu {{ request()->routeIs('permission-requests') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fa fa-list-ul" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> All Applications </div>
                </a>
            </li>

        {{-- @endcan --}}

        @can('application-form')
            <li>
                <a href="{{ route('terms-conditions') }}" class="side-menu {{ request()->routeIs('terms-conditions') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-rectangle-list" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> Application Form </div>
                </a>
            </li>
        @endcan
        @can('cancel-application')
            <li>
                <a href="{{ route('cancel-application-list') }}" class="side-menu {{ request()->routeIs('cancel-application-list') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-rectangle-list" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> Cancel Application</div>
                </a>
            </li>
        @endcan
        @can('make-payment')
            <li>
                <a href="{{ route('payment-list',0) }}" class="side-menu {{ request()->routeIs('payment-list') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-rectangle-list" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> Make Payment</div>
                </a>
            </li>
        @endcan
        @can('qr-code')
            <li>
                <a href="{{ route('qr-code-list') }}" class="side-menu {{ request()->routeIs('qr-code-list') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-qrcode" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> QR Code</div>
                </a>
            </li>
        @endcan
        @can('certificate')
            <li>
                <a href="{{ route('certificate-list') }}" class="side-menu {{ request()->routeIs('certificate-list') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-stamp" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> Certificates</div>
                </a>
            </li>
        @endcan
        @can('report.view')
            <li>
                <a href="{{ route('reports.index') }}" class="side-menu {{ request()->routeIs('reports.index') ? 'side-menu--active side-menu--open' : '' }}">
                    <div class="side-menu__icon"> <i class="fas fa-stamp" aria-hidden="true"></i> </div>
                    <div class="side-menu__title"> Report</div>
                </a>
            </li>
        @endcan

        <li>
            <a href="{{ route('show-change-password') }}" class="side-menu {{ request()->routeIs('show-change-password') ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i class="fas fa-lock" aria-hidden="true"></i> </div>
                <div class="side-menu__title"> Change Password </div>
            </a>
        </li>

        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="side-menu {{ request()->routeIs('logout') ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i class="fas fa-arrow-right-from-bracket" aria-hidden="true"></i> </div>
                <div class="side-menu__title"> Logout </div>
            </a>
        </li>
    </ul>
</nav>
