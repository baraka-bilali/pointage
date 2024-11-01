    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="{{route('dashboard')}}">
                <img src="{{asset ('adminProvidence/vendors/images/logo.png')}}" width="50px" height="50px" alt="" class="light-logo"> &nbsp; <br> administrative
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="{{ route('dashboard') }}" class="dropdown-toggle no-arrow">
                            <span class="micon icon-copy fa fa-dashboard"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <ul id="accordion-menu">
                        <li class="dropdown">
                            <a href="{{ route('agents.index') }}" class="dropdown-toggle">
                                <span class="micon icon-copy fa fa-group"></span><span class="mtext">Agents</span>
                            </a>
                        </li>
                    </ul>
                    <ul id="accordion-menu">
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle">
                                <span class="micon icon-copy fa fa-group"></span><span class="mtext">Rapport</span>
                            </a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
