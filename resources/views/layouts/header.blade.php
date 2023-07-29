<header class="header_area" style="height: 100px">
    <div class="header_navbar" id="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img id="logo" src="{{ asset('storage/assets/logo.png') }}" alt="Logo">
                        </a>
                        <button class="navbar-toggler" type="\button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a href="{{route('home')}}#home">{{ __('navbar.home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('courses')}}">{{ __('navbar.courses') }}</a>
                                </li>
                                @guest
                                    <li class="nav-item">
                                        <a class="header-btn btn-hover" href="{{route('register')}}">Get Started</a>
                                    </li>
                                @endguest
                                @auth
                                    @if(App\Models\User::findOrFail(auth()->id())->role !== 2)
                                    <li class="nav-item">
                                        <a class="page-scroll" href="{{route('register_instructor')}}">{{ __('navbar.instructor') }}</a>
                                    </li>
                                    @endif
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">{{ __('general.logout') }}</button>
                                    </form>
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

                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header navbar -->
</header>
