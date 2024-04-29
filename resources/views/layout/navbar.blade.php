<div class="header-container fixed-top" style="border: 0 !important;">
    <header style="background-color: rgba(255,67,1) !important;" class="header navbar navbar-expand-sm">

        <ul style="background-color: white !important;" class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item">
                <a href="{{route('dashboard.home')}}" class="nav-link logo">
                    <img src="{{asset('images/logo.png')}}" class="flag-width" alt="flag">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a style="color: rgba(255,67,1) !important;" href="{{route('dashboard.home')}}" class="nav-link">
                    @if(app()->getLocale() == 'ar')
                        سيارات
                    @else
                        Sayaraat
                    @endif
                </a>
            </li>
        </ul>
        <ul style="background-color: rgba(255,67,1) !important;" class="navbar-item flex-row ml-md-auto">

            <li class="nav-item dropdown language-dropdown">
                @if(app()->getLocale() == 'ar')
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset(app()->getLocale().'/assets/img/ksa-circle.png')}}" class="flag-width"
                             alt="flag">
                    </a>
                @else
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="language-dropdown"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{asset(app()->getLocale().'/assets/img/ca.png')}}" class="flag-width" alt="flag">
                    </a>
                @endif

            </li>

            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img
                        src="{{auth()->user()?->image? : asset(app()->getLocale().'/assets/img/90x90.jpg')}}"
                        alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        @auth()
                            <div class="dropdown-item">
                                <a class="" href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    {{__('dash.signout')}}</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        @endauth
                        @guest()
                            <div class="dropdown-item">
                                <a class="" href="{{route('login')}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-log-in">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    {{__('dash.login')}}</a>
                            </div>
                        @endguest
                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>


