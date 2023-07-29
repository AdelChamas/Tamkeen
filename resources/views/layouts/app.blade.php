<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @if(app()->getLocale() == 'ar')
            @vite(['resources/css/animate.css', 'resources/css/LineIcons.2.0.css', 'resources/css/style-rtl.css'])
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
        @else
            @vite(['resources/css/animate.css', 'resources/css/LineIcons.2.0.css', 'resources/css/style.css'])
        @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    @vite(['resources/js/wow.min.js', 'resources/js/main.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/assets/logo.png') }}">
    </head>
    <body>
        <div class="min-h-screen bg-gray-100">
            <!--[if IE]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
            <![endif]-->
            @include('layouts.home_page_header')

            <main>
                {{ $content }}
            </main>
        </div>

    @include('layouts.footer')
    </body>
</html>
