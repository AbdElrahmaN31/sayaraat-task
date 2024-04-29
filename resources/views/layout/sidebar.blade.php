<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    @auth()
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu">
                    <a href="{{route('dashboard.home')}}" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span>{{__('dash.dashboard')}}</span>
                        </div>
                    </a>
                </li>

                @if(auth()->user()?->role === 'admin')
                    <li class="menu">
                        <a href="#departments" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <div class="icon-container">
                                    <i data-feather="monitor"></i><span class="icon-name"> {{__('dashboard.departments')}}</span>
                                </div>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="departments" data-parent="#accordionExample">
                            <li>
                                <a href="{{route('departments.index')}}"> {{__('dashboard.view_section', ['section' => __('dashboard.departments')])}} </a>
                            </li>
                            @if(auth()->user()?->role === 'admin')
                                <li>
                                    <a href="{{route('departments.create')}}"> {{__('dashboard.add_section', ['section' => __('dashboard.department')])}} </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if(in_array(auth()->user()?->role, ['admin', 'manager']))
                    <li class="menu">
                        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <div class="icon-container">
                                    <i data-feather="monitor"></i><span class="icon-name"> {{__('dashboard.employees')}}</span>
                                </div>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="users" data-parent="#accordionExample">
                            <li>
                                <a href="{{route('employees.index')}}"> {{__('dashboard.employees')}} </a>
                            </li>
                            @if(in_array(auth()->user()?->role, ['admin', 'manager']))
                                <li>
                                    <a href="{{route('employees.create')}}"> {{__('dashboard.add_section', ['section' => __('dashboard.employee')])}} </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif

                <li class="menu">
                    <a href="#tasks" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <div class="icon-container">
                                <i data-feather="monitor"></i><span class="icon-name"> {{__('dash.tasks')}}</span>
                            </div>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled" id="tasks" data-parent="#accordionExample">
                        <li>
                            <a href="{{route('tasks.index')}}"> {{__('dashboard.view_section', ['section' => __('dash.tasks')])}} </a>
                        </li>
                        @if(in_array(auth()->user()?->role, ['admin', 'manager']))
                            <li>
                                <a href="{{route('tasks.create')}}"> {{__('dashboard.add_section', ['section' => __('dash.task')])}} </a>
                            </li>
                        @endif

                    </ul>
                </li>

                {{--            <li class="menu">--}}
                {{--                <a href="#setting" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">--}}
                {{--                    <div class="">--}}
                {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                {{--                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"--}}
                {{--                             stroke-linejoin="round" class="feather feather-settings">--}}
                {{--                            <circle cx="12" cy="12" r="3"></circle>--}}
                {{--                            <path--}}
                {{--                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>--}}
                {{--                        </svg>--}}

                {{--                        <span>{{__('dash.System settings')}}</span>--}}
                {{--                    </div>--}}
                {{--                    <div>--}}
                {{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"--}}
                {{--                             fill="none"--}}
                {{--                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"--}}
                {{--                             class="feather feather-chevron-right">--}}
                {{--                            <polyline points="9 18 15 12 9 6"></polyline>--}}
                {{--                        </svg>--}}
                {{--                    </div>--}}
                {{--                </a>--}}
                {{--                <ul class="collapse submenu list-unstyled" id="setting" data-parent="#accordionExample">--}}
                {{--                    <li>--}}
                {{--                        <a href="{{route('dashboard.country.index')}}"> {{__('dash.Countries')}} </a>--}}
                {{--                    </li>--}}
                {{--                    <li>--}}
                {{--                        <a href="{{route('dashboard.region.index')}}"> {{__('dash.Regions')}} </a>--}}
                {{--                    </li>--}}
                {{--                    <li>--}}
                {{--                        <a href="{{route('dashboard.city.index')}}"> {{__('dash.Cities')}} </a>--}}
                {{--                    </li>--}}


                {{--                </ul>--}}
                {{--            </li>--}}

            </ul>

        </nav>
    @endauth

</div>

<!--  END SIDEBAR  -->
