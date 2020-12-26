<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Favicon icon -->
        <link rel="shortcut icon" href="{{ asset('img/favicon-32x32.png') }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">

        <!-- KnockoutJS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js" integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA==" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if(Auth::user()->role == 1)
                            <a href="{{ url('/admin') }}">Home</a>
                        @elseif(Auth::user()->role ==2)
                            <a href="{{ url('/user') }}">Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Syncit Group
                </div>
            </div>
        </div>
    </body>
</html>
