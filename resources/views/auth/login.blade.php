@extends('layout.guest')
@section('content')
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="text-center my-5">
                    <img src="{{asset('images/logo.png')}}" class="flag-width" alt="flag"
                         style="width: 150px;margin-top: 33px"/>
                </div>

                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">{{__('dash.login')}}</h1>
                        <p class="">{{__('dash.login_to_your_account')}}</p>

                        <form class="text-left" method="post" action="{{route('login')}}">
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="user_email">{{__('dash.email_phone')}}</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="email_phone" name="email_phone" type="text" class="form-control">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <input id="password" name="password" type="password" class="form-control"
                                           placeholder="Password">
                                </div>
                                <div class="field-wrapper text-center keep-logged-in">
                                    <div class="n-chk new-checkbox checkbox-outline-primary text-left py-2">
                                        <label class="new-control new-checkbox checkbox-outline-primary">
                                            <input type="checkbox" name="remember_me" class="new-control-input">
                                            <span class="new-control-indicator"></span>{{__('dash.remember_me')}}
                                        </label>
                                    </div>
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary"
                                                value="">{{__('dash.login')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
