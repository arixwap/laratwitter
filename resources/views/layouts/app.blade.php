<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lara Twitter</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/w3.css') }}" rel="stylesheet">
    <style type="text/css">
        html, body {
            height: 100%;
        }
        .text-no-decoration {
            text-decoration: none !important;
        }
    </style>
</head>
<body class="w3-grey">
    <div class="w3-container w3-center w3-padding-large w3-cyan w3-text-white" style="position: fixed; z-index: 9999; width: 100%;">
        @guest
            <span class="w3-large w3-wide">Lara Twitter</span>
        @else
            <div class="w3-dropdown-hover w3-transparent">
                <a class="w3-large w3-wide w3-text-white w3-hover-text-light-gray text-no-decoration" href="#">Lara Twitter</a>
                <div class="w3-dropdown-content w3-bar-block w3-border">
                    <span class="w3-bar-item w3-border-bottom"><strong>Hello {{Auth::user()->name}}</strong></span>
                    <a href="{{ url('/') }}" class="w3-bar-item w3-hover-light-blue w3-hover-text-white text-no-decoration">Home</a>
                    <a href="{{ url('profile') }}" class="w3-bar-item w3-hover-light-blue w3-hover-text-white text-no-decoration">Profile</a>
                    <a href="{{ route('logout') }}" class="w3-bar-item w3-hover-light-blue w3-hover-text-white text-no-decoration" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">Logout</a>
                </div>
            </div>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest
    </div>
    <div class="w3-content w3-light-grey w3-padding" style="max-width: 800px; min-height: 100%;">
        <div class="w3-container" style="margin-top: 50px;">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
