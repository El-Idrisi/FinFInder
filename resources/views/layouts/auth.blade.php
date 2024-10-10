<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="bg-sky-50 font-inter">

    <div class="items-center justify-center h-screen lg:flex lg:px-48">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
