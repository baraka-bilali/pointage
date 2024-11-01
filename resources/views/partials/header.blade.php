<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        
    </div>
    <div class="header-right">
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        @auth
                        <img src="{{ asset('adminProvidence/src/images/User.png') }}" height="10px" width="35px" alt="">
                    @endauth
                    </span>
                    <span class="user-name">{{ Auth::user()?->email }} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    {{-- <a class="dropdown-item" href="{{ route('agents.show', $agent->id) }}"><i class="dw dw-user1"></i> Profile</a>                  --}}
                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="dw dw-logout"></i>Se deconnecter
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
