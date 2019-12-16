<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('agent.dashboard.index') }}"><img src="{{ asset('images/deskdesk.png') }}" alt="DeskDesk" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('agent.dashboard.index') }}"><img src="{{ asset('images/deskdesk-icon.png') }}" alt="DeskDesk" /></a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>

        <ul class="navbar-nav navbar-nav-right">

            @if (Auth::check())
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-text">
                            <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                        <div class="p-2">
                            <h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">{{ __('Ações') }}</h5>
                            <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{ route('agent.logout') }}">
                                <span>{{ __('Sair') }}</span>
                                <i class="mdi mdi-logout ml-1"></i>
                            </a>
                        </div>
                    </div>
                </li>
            @else
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link" href="{{ route('customer.login') }}">{{ __('Acessar minha conta') }}</a>
                </li>
            @endif
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
