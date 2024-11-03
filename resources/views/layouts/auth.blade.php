<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    <title>{{ $title }}</title>
</head>

<body class="bg-sky-50 font-inter">

    <div id="particles-js" class="absolute hidden w-screen h-screen -z-10 lg:block"></div>

    <div class="items-center justify-center h-screen lg:flex lg:px-48">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        particlesJS.load('particles-js', '{{ asset('assets/particles.json') }}', function() {
            console.log('callback - particles.js config loaded');
        });

        @if (Session::has('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Nice'
            })
        @endif

        @if (Session::has('status'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'Nice'
            })
        @endif

        function showPassword(inputId) {
            var input = document.getElementById(inputId);
            const eyeIcon = document.getElementById(`eye-icon-${inputId}`)
            if (input.type === "password") {
                input.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                input.type = "password";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>

</html>
