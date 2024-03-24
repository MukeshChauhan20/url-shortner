<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @auth
                            @if(auth()->user()->package != 'Enterprise')
                            <li class="nav-item">
                                <a class="btn btn-outline-success" href="#" role="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Upgrade Plan
                                </a>
                            </li>
                            @endif
                        @endauth
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @auth
        @if(auth()->user()->package != 'Enterprise')
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upgrade Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-4">                        
                            <div class="card card-pricing text-center px-3 mb-4 h-100">
                                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Basic @if(auth()->user()->package == 'Basic')<span class="badge bg-warning text-dark">Active</span> @endif</span>
                                <div class="bg-transparent card-header pt-4 border-0">
                                    <h1 class="h1 font-weight-normal text-primary text-center mb-0" >Free</h1>
                                </div>
                                <div class="card-body pt-0">
                                    <ul class="list-unstyled mb-4">
                                        <li>Up to 10 links</li>
                                        <li>Basic support on Github</li>
                                        <li>Monthly updates</li>
                                        <li>Free cancelation</li>
                                    </ul>
                                    @if(auth()->user()->package != 'Basic')
                                    <button type="button" class="btn btn-outline-secondary mb-3 order-now" data-package="Basic">Order now</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">                        
                            <div class="card card-pricing text-center px-3 mb-4 h-100">
                                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Advance @if(auth()->user()->package == 'Advanced')<span class="badge bg-warning text-dark">Active</span> @endif</span>
                                <div class="bg-transparent card-header pt-4 border-0">
                                    <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="60">$<span class="price">5</span><span class="h6 text-muted ml-2">/ per month</span></h1>
                                </div>
                                <div class="card-body pt-0">
                                    <ul class="list-unstyled mb-4">
                                        <li>Up to 1000 links</li>
                                        <li>Basic support on Github</li>
                                        <li>Monthly updates</li>
                                        <li>Free cancelation</li>
                                    </ul>
                                    @if(auth()->user()->package != 'Advanced')
                                    <button type="button" class="btn btn-outline-secondary mb-3 order-now" data-package="Advanced">Order now</button>                                
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">                        
                            <div class="card card-pricing text-center px-3 mb-4 h-100">
                                <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Enterprise @if(auth()->user()->package == 'Enterprise')<span class="badge bg-warning text-dark">Active</span> @endif</span>
                                <div class="bg-transparent card-header pt-4 border-0">
                                    <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="60">$<span class="price">12</span><span class="h6 text-muted ml-2">/ per month</span></h1>
                                </div>
                                <div class="card-body pt-0">
                                    <ul class="list-unstyled mb-4">
                                        <li>Unlimited Links</li>
                                        <li>Basic support on Github</li>
                                        <li>Monthly updates</li>
                                        <li>Free cancelation</li>
                                    </ul>
                                    @if(auth()->user()->package != 'Enterprise')
                                    <button type="button" class="btn btn-outline-secondary mb-3 order-now" data-package="Enterprise">Order now</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endif   
    @endauth
    
    </body>
</html>
