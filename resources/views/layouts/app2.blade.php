<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BTL_eRecruitment') }}</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hover-min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css">

    <!-- Add Bootstrap CSS and JavaScript links here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS (make sure you have this included) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
<!-- Bootstrap JS (make sure you include it after your HTML code) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .custom-width {
            max-width: 100%;
            /* Set your desired maximum width */
            margin: 0 auto;
            /* Center the container horizontally if needed */
        }
    
    </style>
   
   
    <!-- Javascript Files -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
</head>
<body>
     <section>
        <header id="header" class="header fixed-top">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand navbar-light bg-light"
                        style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                        <a class="navbar-brand" href="/">
                            {{-- <i class="fas fa-home"></i>  --}}

                            <img src="../images/logo.png" alt="logo" width="60">

                            <span class="pl-3 cd-headline">Bhutan Telecom e-Recruitment</span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                @guest
                                    <!-- Guest navigation links -->
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                            <i class="fas fa-sign-in-alt"></i>
                                        </a>
                                    </li>
                                @else
                                    @php
                                        $userRole = auth()->user()->role; // Assuming 'role' is a field in your User model representing the user's role
                                    @endphp
                        
                                    @if($userRole == 'panel 1')
                                        <!-- Only show this link for panel 1 -->
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('shortlisted-candidate') }}">{{ __('Shortlisted Candidate') }}</a>
                                        </li>
                                    @else
                                        <!-- Navigation links for admin and super admin -->
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                        </li>
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('create-vacancy') }}">{{ __('Create Vacancy') }}</a>
                                        </li>
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('show-vacancy') }}">{{ __('Vacancy List') }}</a>
                                        </li>
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('shortlisted-candidate') }}">{{ __('Shortlisted Candidate') }}</a>
                                        </li>
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('result') }}">{{ __('Results') }}</a>
                                        </li>
                                        <li class="nav-item dropdown ml-2 mr-2 mt-1">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ __('Setting') }}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="{{ route('change_pwd') }}">{{ __('Change Password') }}</a></li>
                                                <li><a class="dropdown-item" href="{{ route('report') }}">{{ __('Report') }}</a></li> <!-- Added Report option -->
                                            </ul>
                                        </li>
                                        <li class="nav-item ml-2 mr-2 mt-1">
                                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('Logout') }}
                                                <i class="fas fa-sign-out-alt"></i>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif
                                @endguest
                            </ul>
                        </div>
                        
                    </nav>
                </div>
            </div>  
        </header>
    </section>
    <main>
        @yield('content')
    </main>
    <!-- Footer -->
    <footer id="footer" class="fixed-footer">
        {{-- <div class="container"> --}}
        <div class="d-flex content-justify-between">
            <div class="col-md-12 col-12 text-center text-lg-left text-md-left">
                <p class="copyright">Copyright © Bhutan Telecom Limited | Contact us: (+975)343434
                    <?php echo date('Y'); ?>.
                </p>
            </div>

        </div>
        {{-- </div> --}}
    </footer>
</body>
</html>
