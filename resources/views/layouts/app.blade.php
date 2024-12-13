<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    <title>{{ $title }}</title>
</head>

<body class="relative font-inter -z-[9999] overflow-x-hidden">
    {{-- Navbar --}}
    <x-navbar></x-navbar>

    @yield('content')

    {{-- Footer --}}
    <x-footer></x-footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header');

            window.onscroll = function() {
                const fixedNav = header.offsetTop;

                if (window.pageYOffset > fixedNav) {
                    header.classList.add('navbar-fixed');
                } else {
                    header.classList.remove('navbar-fixed');
                }

            }

            const hambuger = document.querySelector(".hamburger-icon")
            const navMenu = document.querySelector("#nav-menu")
            hambuger.addEventListener('click', () => {
                navMenu.classList.toggle("-translate-y-full")
                hambuger.classList.toggle("hamburger-active")
            });

        });
    </script>
    @stack('script')
</body>

</html>
