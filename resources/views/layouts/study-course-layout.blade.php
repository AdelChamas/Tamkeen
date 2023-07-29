<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    @if(app()->getLocale() == 'ar')
    @vite([
         'resources/js/wow.min.js',
          'resources/js/main.js',
          'resources/css/course-rtl.css',
          'resources/css/style-rtl.css'])
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    @else
    @vite([
         'resources/js/wow.min.js',
          'resources/js/main.js',
          'resources/css/course.css',
          'resources/css/style.css'])
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @endif
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo.png') }}">

</head>
<body>
<div class="min-h-screen bg-gray-100">
    <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <header class="header_area text-center" style="height: 75px; position: fixed; width: 109px;">
        <div class="header_navbar" id="header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg" style="padding: 21px 0;">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img id="logo" src="{{ asset('storage/assets/logo.png') }}" alt="Logo">
                            </a>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
<script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('.sidebar'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch");


    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })

    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    })

</script>

</body>
</html>
