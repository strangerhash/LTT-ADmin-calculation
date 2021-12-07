<nav class="hk-nav hk-nav-dark">
    <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
    <div class="nicescroll-bar">
        <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/dashboard') }}">
                        <span class="feather-icon"><i data-feather="home"></i></span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>THRIFT SYSTEM</span>
                <span>TS</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_pie">
                        <span class="feather-icon"><i data-feather="pie-chart"></i></span>
                        <span class="nav-link-text">Long Term Thrift</span>
                    </a>
                    <ul id="pages_pie" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pie-accounts')}}">LTT Accounts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pie-purchase')}}">Purchase LTT Unit(s)</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pie-withdrawal')}}">Withdrawal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('pie-transactions')}}">Transactions</a>
                                </li> --}}
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_dthrift">
                        <span class="feather-icon"><i data-feather="shopping-bag"></i></span>
                        <span class="nav-link-text">Short Term Thrifts</span>
                    </a>
                    <ul id="pages_dthrift" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('digital-thrift-accounts')}}">STT Accounts</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('digital-thrift-purchase')}}">Purchase STT Unit(s)</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('digital-thrift-transactions')}}">Thrifts Transactions</a>
                                </li> --}}
                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="{{ route('buy-pie-units') }}">
                        <span class="feather-icon"><i data-feather="shopping-bag"></i></span>
                        <span class="nav-link-text">Buy PIE Units (LTT)</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('pie-history') }}">
                        <span class="feather-icon"><i data-feather="pie-chart"></i></span>
                        <span class="nav-link-text">My PIE Accounts</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ url('/pie/withdrawal') }}">
                        <span class="feather-icon"><i data-feather="pie-chart"></i></span>
                        <span class="nav-link-text">Withdrawal</span>
                    </a>
                </li> --}}
                <li class="nav-item ">
                    <a class="nav-link" href= "https://www.valstores.com/cashbackshopping/" target="_blank">
                        <span class="feather-icon"><i data-feather="repeat"></i></span>
                        <span class="nav-link-text">Cashback shopping</span>
                    </a>
                </li>
            </ul>
            <hr class="nav-separator">
            <div class="nav-header">
                <span>MATRIX SYSTEM</span>
                <span>MS</span>
            </div>
            <ul class="navbar-nav flex-column">
                @if ((int) Auth::user()->is_upgraded == 0)
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('user_upgrade') }}" id="upgrade_url">
                            <span class="feather-icon"><i data-feather="zap"></i></span>
                            <span class="nav-link-text">Upgrade Account</span>
                        </a>
                    </li>
                @endif
                
                
                
                
               <!--MY MATRIX DROPDOWN-->
               <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_matrix">
                        <span class="feather-icon"><i data-feather="git-commit"></i></span>
                        <span class="nav-link-text">My Matrix</span>
                    </a>
                    <ul id="pages_matrix" class="nav flex-column collapse collapse-level-1">
                        <li class="nav-item">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('matrix-quorum') }}">Quorum Matrix</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('matrix-geneology-tree') }}">Geneology Tree</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('matrix-downlines')}}">Downlines List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('matrix-referrals')}}">Referrals List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('matrix-incentives')}}">Earned Incentives</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item ">
                    <a class="nav-link" href="{{ url('/my-matrix') }}">
                        <span class="feather-icon"><i data-feather="shopping-bag"></i></span>
                        <span class="nav-link-text">My Matrix</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ url('/geneology') }}">
                        <span class="feather-icon"><i data-feather="loader"></i></span>
                        <span class="nav-link-text">Geneology</span>
                    </a>
                </li> --}}
                
                
                
               <!--DROPDOWN CLOSE-->
               
               
               
               
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('matrix-referrals')}}">
                        <span class="feather-icon"><i data-feather="git-commit"></i></span>
                        <span class="nav-link-text">Referrals List</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('fund-wallet') }}">
                        <span class="feather-icon"><i data-feather="credit-card"></i></span>
                        <span class="nav-link-text">Fund Wallet</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('withdrawal') }}">
                        <span class="feather-icon"><i data-feather="credit-card"></i></span>
                        <span class="nav-link-text">Withdrawal</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('account-statement') }}">
                        <span class="feather-icon"><i data-feather="clipboard"></i></span>
                        <span class="nav-link-text">Account Statement</span>
                    </a>
                </li>
            </ul>
            {{-- <hr class="nav-separator">
            <div class="nav-header">
                <span>My Statements</span>
                <span>MS</span>
            </div>
            <ul class="navbar-nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('mtpack-history') }}">
                        <span class="feather-icon"><i data-feather="list"></i></span>
                        <span class="nav-link-text">MT Pack History</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('account-statement') }}">
                        <span class="feather-icon"><i data-feather="clipboard"></i></span>
                        <span class="nav-link-text">Account Statement</span>
                    </a>
                </li>
            </ul> --}}
            <hr class="nav-separator">
            <div class="nav-header">
                <span>Other Opportunities</span>
                <span>OO</span>
            </div>
            <ul class="navbar-nav flex-column">
                {{-- <li class="nav-item">
                    <a class="nav-link" href="https://www.valstores.com/cashbackshopping/" target="_blank">
                        <span class="feather-icon"><i data-feather="external-link"></i></span>
                        <span class="nav-link-text">Cashback</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://valstores.com/" target="_blank">
                        <span class="feather-icon"><i data-feather="external-link"></i></span>
                        <span class="nav-link-text">Shop</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                   <a class="nav-link" href="#" style="pointer-events: none;" >
                        <span class="feather-icon"><i data-feather="external-link"></i></span>
                        <span class="nav-link-text text-muted"><strike>Recharge & Earn</strike></span>
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
