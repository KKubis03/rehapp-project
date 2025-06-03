<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        {{$title}}
    </title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/css/custom-css.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body id="body" class="bg-light text-dark">
    @auth
        <nav id="navbar" class="navbar navbar-expand-lg bg-light text-dark">
            <div class="container-fluid bg-light text-dark" id="navbar-items">
                <a class="navbar-brand text-primary fw-bold" href="#">Rehapp</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'text-primary fw-bold' : 'text-dark' }}"
                                aria-current="page" href="/">Home</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('patients*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/patients">Patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('appointments*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/appointments">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('services*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('physiotherapists*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/physiotherapists">Physiotherapists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('logout*') ? 'text-primary fw-bold' : 'text-dark' }}"
                                href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth
    @yield ("content")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>