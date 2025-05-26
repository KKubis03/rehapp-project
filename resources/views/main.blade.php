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
</head>

<body id="body" class="bg-light text-dark">
    @auth
        <nav id="navbar" class="navbar navbar-expand-lg bg-light text-dark">
            <div class="container-fluid bg-light text-dark" id="navbar-items">
                <a class="navbar-brand text-primary" href="#">Rehapp</a>
                <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/patients">Patients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/appointments">Appointments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/physiotherapists">Physiotherapists</a>
                        </li>
                        <li class="nav-item">
                            <div class="form-check form-switch text-white ms-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="themeSwitch">
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <div class="form-check form-switch text-white ms-2">
                                <input class="form-check-input" type="checkbox" role="switch" id="langSwitch">
                            </div>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endauth
    @yield ("content")
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const themeSwitch = document.getElementById('themeSwitch');
        const body = document.getElementById('body');
        const navbar = document.getElementById('navbar');
        const navbarItems = document.getElementById('navbar-items');
        const navLinks = document.querySelectorAll('#navbar-items .nav-link');
        if (localStorage.getItem('theme') === 'dark') {
            themeSwitch.checked = true;
            applyDarkMode();
        }
        themeSwitch.addEventListener('change', function () {
            if (this.checked) {
                localStorage.setItem('theme', 'dark');
                applyDarkMode();
            } else {
                localStorage.setItem('theme', 'light');
                applyLightMode();
            }
        });
        function applyDarkMode() {
            body.classList.remove('bg-light', 'text-dark');
            navbar.classList.remove('bg-light', 'text-dark');
            navbarItems.classList.remove('bg-light', 'text-dark');
            body.classList.add('bg-dark', 'text-white');
            navbar.classList.add('bg-dark', 'text-white');
            navbarItems.classList.add('bg-dark', 'text-white');
            navLinks.forEach(link => {
                link.classList.remove('text-dark');
                link.classList.add('text-white');
            });
        }
        function applyLightMode() {
            body.classList.remove('bg-dark', 'text-white');
            navbar.classList.remove('bg-dark', 'text-white');
            navbarItems.classList.remove('bg-dark', 'text-white');
            body.classList.add('bg-light', 'text-dark');
            navbar.classList.add('bg-light', 'text-dark');
            navbarItems.classList.add('bg-light', 'text-dark');
            navLinks.forEach(link => {
                link.classList.remove('text-white');
                link.classList.add('text-dark');
            });
        }
    });
</script>