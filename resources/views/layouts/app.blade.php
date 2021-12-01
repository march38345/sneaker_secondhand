<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .navbar-brand.icon {
            margin-left: 0%;

        }

        .container {
            padding: 0px
            margin-left: 100px;
            width: 100%;
        }

        .navbar.navbar-expand-md.navbar-light.bg-white.shadow-sm {
            padding-left: 0px;


        }

        .sale {
            margin-left: 20px;

            text-decoration: none;

        }

        .sale {
            margin-left: 20px;
            color: black;
            text-decoration: none;
            border-bottom: 2px solid transparent;

            padding: 0px;
            transition: all 0.3s ease;
        }

        .sale:hover {
            color: black;
            padding-bottom: 5px;

        }
        .navbar{
            margin: 0px;
            padding-top: 0px;
            

        }
        
footer {
    background-color: rgb(53, 50, 50);'
 
}

.p-h {
    color: rgb(241, 238, 234);
    margin: 0px;
    font-weight: 1000;
    font-size: 18px;
}

.fl {
    margin-top: 20px;
}

.contactp {
    width: 80%;
    color: white;
    padding-left: 5px;
}

.social {
    font-size: 20px;
    margin-left: 3px;
    text-decoration: none;
}

.social:hover {
    text-decoration: none;
}

.footerlist {
    color: white;
}

main {
    padding-bottom: 0px;
}

footer {
    margin-bottom: 0px;
}

    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding-top: 0px; padding-bottom:0px">
            <div class="container">
                <a class="navbar-brand icon" href="{{ url('/') }}">

                    <img src="/image/logo.png" width="100px" height="40px">
                </a>

                <a href="{{ route('home') }}" class='sale home'>home</a>
                <a href="{{ route('market') }}" class='sale market'>market</a>
                <a href="{{ route('set_for_sale') }}" class='sale set'>sale</a>



                <a href="{{route('viewchat')}}"><i data-feather="message-square" class="sale"></i></a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/profile/{{ Auth::user()->id }}" class="dropdown-item">Profile</a>
                                    @if (auth()->user()->is_admin == 1)
                                        <a href="{{ route('admin.home') }}" class='dropdown-item'>Admin</a>

                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

      
            @yield('content')
      
    </div>
</body>

<footer>
    <div class="container">
        <div class="col-12">

            <div class="row" width="100%">
                <div class="container col-lg-4 col-sm-4 fl">
                    <p class="p-h">เมนูหลัก</p>
                    <ul>
                        <li>
                            <a href="" class="footerlist">หน้าขายสินค้า</a>
                        </li>
                        <li>
                            <a href="" class="footerlist">หน้าตั้งขายสินค้า</a>
                        </li>
                        <li>
                            <a href="" class="footerlist">แชทสนทนา</a>

                        </li>
                    </ul>


                </div>
                <div class="container col-lg-4 col-sm-4 fl">
                    <p class="p-h">
                        เกี่ยวกับเรา
                    </p>
                    <p class="contactp">
                        เว็บไซต์ของเราเป็นเว็บไซต์ที่มีจุดประสงค์เพื่อให้ผู้ใช้สามารถตั้งขายสิ้นค้ารองเท้าเพื่อเป็นตัวกลางระหว่างผู้ขายและผู้ซื้อ
                    </p>

                </div>
                <div class="container col-lg-4 col-sm-4 fl">
                    <p class="p-h">ติดตามข่าวสาร</p>
                    <a href="" class="social">
                        <i class="bi bi-facebook "></i>
                    </a>
                    <a href="" class="social">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="" class="social">
                        <i class="bi bi-twitter"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>


</footer>

<script>
    feather.replace()
</script>

</html>
