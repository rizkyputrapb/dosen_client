<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dosen.css') }}">

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary" style="">
        <div class="container"> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar18">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar18">
                <a href="/home"><img src="{{ asset('images/logo.png') }}" height="69" width="250"></a>
                <ul class="navbar-nav mx-auto"></ul>
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    @if(Auth::guard('web')->check())
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="kontrakkuliah">Kontrak Kuliah</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="rpskuliah">RPS Mata Kuliah</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="sapkuliah">SAP Mata Kuliah</a>
                    </li>
                    @elseif(Auth::guard('admin')->check())
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="adminhome">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="researchgroup">Research Group</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="position">Jabatan Dosen</a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        @if(Auth::guard('web')->check())
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->code }} <span class="caret"></span>
                        </a>
                        @elseif(Auth::guard('admin')->check())
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('admin')->user()->username }} <span class="caret"></span>
                        </a>
                        @endif
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="/home">Dashboard</a>
            <a class="breadcrumb-item" href="#">@yield('title')</a>
            <span class="breadcrumb-item active"></span>
        </nav>
        @yield('content')
    </div>
</body>
@yield('script')

</html>