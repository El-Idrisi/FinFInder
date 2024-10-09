<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    <title>FinFinder | Login Page</title>
</head>

<body class="bg-sky-50 font-inter">

    <div class="items-center justify-center h-screen lg:flex lg:px-48">

        <div class="flex w-full h-full lg:h-fit shadow-manual ">
            <div class="w-full px-6 py-12 pb-24 lg:px-16 lg:w-1/2 bg-slate-100">
                <div class="flex flex-col justify-center h-full form-container ">
                    <h2 class="text-4xl text-center lg:text-start">SIGN IN</h2>
                    <form action="{{ route('login.submit') }}" method="POST" class="mt-4 ">
                        @csrf

                        <div class="flex flex-col my-8">
                            <label for="username" class="mb-2 text-lg font-bold">Username</label>
                            <input type="text" name="username" id="username" placeholder="username"
                                class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500" autocomplete="off">
                        </div>

                        <div class="flex flex-col my-8">
                            <label for="password" class="mb-2 text-lg font-bold">Password</label>
                            <div class="bg-[#e9e9e9] rounded-full flex items-center pass">
                                <input type="password" name="password" id="password" placeholder="password"
                                    class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none ">
                                <a href="#" class="flex items-center" onclick="showPassword('password')">
                                    <i id="eye-icon-password" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
                                </a>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">Login</button>

                        <div class="flex flex-col justify-center gap-4 my-4 md:justify-between md:flex-row">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" id="remember" class="w-4 h-4">
                                <label for="remember" class="ml-2 text-lg text-slate-900">Remember Me</label>
                            </div>
                            <a href="#"
                                class="flex flex-col items-center justify-center text-slate-500 hover:text-slate-700 group">
                                Forget Password
                                <hr
                                    class="hidden w-0 transition-all duration-300 opacity-0 lg:block group-hover:w-full group-hover:opacity-100 group-hover:border-slate-700">
                            </a>
                        </div>
                    </form>
                </div>
                <p class="absolute left-0 w-full text-center bottom-10 lg:hidden">Need an Account <a href="#"
                        class="text-sky-500">Register Here</a></p>
            </div>
            <div class="lg:w-1/2 w-0 hidden lg:block bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
                <div class="flex flex-col items-center justify-center h-full gap-8 text-slate-100">
                    <h3 class="text-5xl font-bold">Welcome To Login</h3>
                    <p class="text-xl">Need an Account</p>
                    <a href="#"
                        class="px-4 py-2 transition-all duration-500 border-2 rounded-full border-slate-100 bg-size-200 bg-gradient-to-r from-sky-600 via-sky-500 to-sky-300 bg-pos-100 hover:bg-pos-0">Register
                        Here</a>
                </div>
            </div>
        </div>

    </div>
    <script>
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
