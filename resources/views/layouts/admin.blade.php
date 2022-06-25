<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <!-- Titolo della navbar -->
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Laravel Auth</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <input class="form-control form-control-dark w-50" type="text" placeholder="Search" aria-label="Search">
            <!-- Bottone del logout  -->
            <div class="navbar-nav">
                <div class="nav-item text-nowrap">
                    <!-- Bottone del logout -->
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid">
            <div class="row d-flex justify-content-center w-100">
                <!-- Sidebar laterale -->
                <nav id="sidebarMenu" class="col-md-3 bg-light sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <!-- Dashboard -->
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.posts.index')}}">Posts</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.categories.index')}}">Categories</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Tags</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
                        </ul>
                    </div>
                </nav>
                <!-- Menu -->
                <main class="col-9 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
