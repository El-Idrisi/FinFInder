<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @stack('style')
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="relative font-inter -z-[9999] overflow-x-hidden bg-sky-50">

    <x-sidebar-dashboard></x-sidebar-dashboard>
    <div class="fixed top-0 bottom-0 w-full bg-black z-[9]  scale-0 transition-all duration-100 bg-opacity-0"
        id="bg-cover"></div>

    <div class="lg:ml-[240px]" id="content">
        <x-navbar-dashboard></x-navbar-dashboard>

        <div class="px-8 pb-12 pt-28">
            @yield('content')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(acc => {
            acc.addEventListener('click', function() {
                var panel = this.nextElementSibling;
                if (!panel.classList.contains('accor')) {
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                        this.classList.toggle('active')
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                        this.classList.toggle('active')
                    }
                } else {
                    panel.classList.toggle('active')
                    if (panel.classList.contains("active")) {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    } else {
                        panel.style.maxHeight = "0px";
                    }
                }
            });
        });

        const sidebar = document.querySelector('#sidebar');
        const content = document.querySelector('#content');
        const hambuger = document.querySelector("#hambuger")
        const bgCover = document.querySelector("#bg-cover")
        const navbar = document.querySelector("#navbar");

        if (window.innerWidth <= 768) {
            hambuger.addEventListener('click', (event) => {
                event.stopPropagation();
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("translate-x-0");
                bgCover.classList.remove("scale-0");
                bgCover.classList.remove("bg-opacity-0");
                bgCover.classList.add("bg-opacity-30");
            });

            document.addEventListener('click', (event) => {
                if (!sidebar.contains(event.target) && !hambuger.contains(event.target)) {
                    sidebar.classList.remove("translate-x-0");
                    sidebar.classList.add("-translate-x-full");
                    bgCover.classList.add("scale-0");
                    bgCover.classList.remove("bg-opacity-30");
                    bgCover.classList.add("bg-opacity-0");
                }
            });

        } else {
            hambuger.addEventListener('click', () => {
                sidebar.classList.toggle("lg:translate-x-0")
                content.classList.toggle("lg:ml-[240px]")
                navbar.classList.toggle("lg:w-[calc(100vw-240px)]")
            });
        }

        @if (Session::has('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Nice'
            })
        @endif
    </script>
    @stack('script')
</body>

</html>
