<header class="header_area">
    <div id="header_navbar" class="header_navbar">
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
                                    <a style="padding: 10px" class="dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if(app()->getLocale() == null)
                                        en
                                    @else
                                        {{ app()->getLocale() }}                                
                                    @endif
                                    </a>
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
