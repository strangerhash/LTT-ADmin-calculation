<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <img class="brand-img d-inline-block" src="{{ asset('assets/dist/img/iscube-logo-sm.png')}}" alt="ISCUBE" />
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
            </li>
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar avatar-sm">
                                <span class="avatar-text avatar-text-success rounded-circle">
                                    <span class="initial-wrap">
                                        <span class="fa fa-user fa-lg"></span>
                                    </span>
                                </span>
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                        <span>{{  Auth::user()->email }}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
