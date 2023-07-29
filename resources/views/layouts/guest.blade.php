<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @if(app()->getLocale() == 'ar')
        @vite(['resources/css/style-rtl.css'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @else
        @vite(['resources/css/style.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @endif
    @vite(['resources/js/wow.min.js', 'resources/js/main.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo.png') }}">
</head>
<body>
<div class="min-h-screen bg-gray-100">
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <header class="header_area" style="height: 100px">
        <div id="header_navbar" class="header_navbar" style="background-color: var(--primary)">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img id="logo" src="{{ asset('storage/assets/logo.png') }}" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{route('home')}}#home">{{ __('navbar.home') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{route('home')}}#courses">{{ __('navbar.courses') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{route('home')}}#contact">{{ __('navbar.contact') }}</a>
                                    </li>
                                    @guest
                                        <li class="nav-item">
                                            <a class="page-scroll" href="{{route('login')}}">{{ __('navbar.login') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="header-btn btn-hover" href="{{route('register')}}">{{ __('navbar.get_started') }}</a>
                                        </li>
                                    @endguest
                                    @auth
                                        <li class="nav-item">
                                            <a class="page-scroll" href="{{route('studentDashboard')}}">{{ __('navbar.dashboard') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn text-light page-scroll">{{ __('navbar.logout') }}</button>
                                            </form>
                                        </li>
                                    @endauth
                                    <div class="dropdown m-1">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if(app()->getLocale() == null)
                                        en
                                        @else
                                            {{ app()->getLocale() }}                                
                                        @endif
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'ar']) }}">ar</a></li>
                                            <li><a class="dropdown-item" href="{{ route('lang', ['lang' => 'en']) }}">en</a></li>
                                        </ul>
                                    </div>

                                    <form class="nav-item search" action="{{ route('search') }}" method="get">
                                        @csrf
                                        <div class="input-group">
                                            <input type="search" id="form1" class="form-control" name="query" placeholder="{{ __('navbar.search') }}" />
                                            <button type="submit" class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5A6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5S14 7.01 14 9.5S11.99 14 9.5 14z"/></svg>
                                            </button>
                                        </div>
                                    </form>
                                </ul>
                            </div> <!-- navbar collapse -->
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header navbar -->
    </header>


    <main>
        {{ $content }}
    </main>
</div>

@include('layouts.footer')
</body>
</html>
