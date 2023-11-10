<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu">
                <i class="fa-solid fa-bars"></i>
                <span class="sr-only"></span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a class="nav-link dropdown-toggle pointer" data-toggle="dropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span>{{ isLoggedIn() ? authUserName() : ___('mycustom.word.guest') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuLink">
                @if ($isViewUserMenuHeader())
                    <li class="user-header">
                        {{ isset($userMenuHeader) ? $userMenuHeader : '' }}
                    </li>
                @endif

                @if ($isViewUserMenuBody())
                    <li class="user-body">
                        {{ isset($userMenuBody) ? $userMenuBody : '' }}
                    </li>
                @endif

                <li class="user-footer">
                    @if ($isViewUserMenuFooter())
                        {{ isset($userMenuFooter) ? $userMenuFooter : '' }}
                    @endif

                    @if ($isViewLogoutButton())
                        <a class="btn btn-default btn-flat float-right btn-block logout-btn">
                            <i class="fa-solid fa-power-off"></i>
                            {{ ___('mycustom.word.logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif

                    @if ($isViewLoginButton())
                        <a class="btn btn-default btn-flat float-right btn-block" href="{{ route('showLoginForm') }}">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            {{ ___('mycustom.word.login') }}
                        </a>
                    @endif
                </li>
            </ul>
        </li>
    </ul>
</nav>
