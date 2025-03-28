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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light py-3 border-bottom border-2 border-dark">
            <div class="container-fluid d-flex">

                    <!-- Left Side Of Navbar -->
                    <div class="d-flex gap-2">
                        @auth
                            <a href="{{ route('sauces.index') }}" class="text-decoration-none fw-bold text-dark">ALL SAUCES</a>
                            <a href="{{ route('sauces.create') }}" class="text-decoration-none text-dark">ADD SAUCE</a>
                        @endauth
                    </div>

                    <!-- Centre : Logo et titre du site -->
                    <a class="navbar-brand d-flex text-center align-items-center mx-auto gap-2" href="{{ url('/') }}">
                        <img width="40" height="40" src="https://img.icons8.com/external-those-icons-fill-those-icons/40/1A1A1A/external-fire-nature-ecology-those-icons-fill-those-icons.png" alt="Logo Hot Takes">
                        <div>
                            <h3 class="fw-bold mb-0" >HOT TAKES</h3>
                            <h6 class="text-secondary mb-0" >THE WEB'S BEST HOT SAUCE REVIEWS</h6>
                        </div>
                    </a>

                    <!-- Right Side Of Navbar -->
                    <div class="d-flex gap-2">
                        <!-- Authentication Links -->
                        @guest

                            @if (Route::has('register'))
                                <a class="nav-link text-dark mb-0" href="{{ route('register') }}">{{ __('SIGN UP') }}</a>
                            @endif
                        
                            @if (Route::has('login'))
                                <a class="nav-link fw-bold text-dark mb-0" href="{{ route('login') }}">{{ __('LOGIN') }}</a>
                            @endif

                        @else

                                <a class="nav-link fw-bold text-dark mb-0" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
