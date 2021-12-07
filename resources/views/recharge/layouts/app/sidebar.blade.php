<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('recharge-dashboard') }}">
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Iscube Recharge</span>
                <span>TS</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('recharge-upgrade-vtu') }}" id="upgrade_url">
                        <span class="feather-icon"><i data-feather="shopping-bag"></i></span>
                        <span class="nav-link-text">Upgrade - OWN ur VTU</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp">
                        <span class="feather-icon"><i data-feather="phone"></i></span>
                        <span class="nav-link-text">Airtime and Data</span>
                    </a>
                    <ul id="pages_drp" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-airtime')}}">Buy Airtime</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-data-bundle')}}">Buy Data Bundle</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_utility">
                            <span class="feather-icon"><i data-feather="zap"></i></span>
                            <span class="nav-link-text">Electricity</span>
                    </a>
                    <ul id="pages_utility" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'AEDC'])}}">Abuja Electric AEDC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'IBEDC'])}}">Ibadan Electric IBEDC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'IKEDC'])}}">Ikeja Electric IKEDC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'KAEDC'])}}">Kaduna Electric KAEDC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'KEDC'])}}">Kano Electric KEDC</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-electricity', ['company' => 'JEDC'])}}">Jos Electric JEDC</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_tv">
                        <span class="feather-icon"><i data-feather="tv"></i></span>
                        <span class="nav-link-text">TV Subscription</span>
                    </a>
                    <ul id="pages_tv" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-tv-subscription', ['company' => 'DSTV'])}}">DSTV</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-tv-subscription', ['company' => 'GOTV'])}}">GOTV</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-tv-subscription', ['company' => 'STARTIMES'])}}">STARTIMES</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_network">
                        <span class="feather-icon"><i data-feather="phone"></i></span>
                        <span class="nav-link-text">My Network</span>
                    </a>
                    <ul id="pages_network" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('recharge-geneology-tree')}}"> Geneology Tree View</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('recharge-transactions') }}">
                        <span class="feather-icon"><i data-feather="shopping-bag"></i></span>
                        <span class="nav-link-text">My Transactions</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('recharge-withdrawal') }}">
                        <span class="feather-icon"><i data-feather="credit-card"></i></span>
                        <span class="nav-link-text">Withdrawal</span>
                    </a>
                </li>
            </ul>

            <hr class="nav-separator">
            <div class="nav-header">
                <span>Account Settings</span>
                <span>AS</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('profile') }}">
                        <span class="feather-icon"><i data-feather="user"></i></span>
                        <span class="nav-link-text">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <span class="feather-icon"><i data-feather="power"></i></span>
                        <span class="nav-link-text">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
