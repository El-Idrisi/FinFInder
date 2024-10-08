<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-sky-50">

    <div class="px-32 py-16">

        <div class="flex w-full shadow-manual">
            <div class="w-1/2 p-6 px-16 py-12 pb-24 bg-slate-100">
                <h2 class="text-4xl ">SIGN IN</h2>
                <form action="" method="POST" class="mt-4 ">
                    @csrf

                    <div class="flex flex-col my-8">
                        <label for="username" class="mb-2 text-lg font-bold">Username</label>
                        <input type="text" name="username" id="username" placeholder="username"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline-none" autocomplete="off">
                    </div>

                    <div class="flex flex-col my-8">
                        <label for="password" class="mb-2 text-lg font-bold">Password</label>
                        <div class="bg-[#e9e9e9] rounded-full flex items-center">
                            <input type="password" name="password" id="password" placeholder="password"
                                class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none ">
                            <a href="#" class="flex items-center">
                                <i class="pr-4 fa-solid fa-eye-slash text-slate-900"></i>
                            </a>
                        </div>
                    </div>

                    <button type="submit" class="w-full py-2 my-4 text-lg font-bold rounded-full bg-gradient-to-r from-sky-400 to-sky-600 text-slate-100">Login</button>

                    <div class="flex justify-between my-4">
                        <div class="flex items-center justify-center">
                            <input type="checkbox" id="remember" class="w-4 h-4">
                            <label for="remember" class="ml-2 text-lg text-slate-900">Remember Me</label>
                        </div>
                        <a href="#" class="flex flex-col items-center justify-center text-slate-500 hover:text-slate-700 group">
                            Forget Password
                            <hr class="w-0 transition-all duration-300 opacity-0 group-hover:w-full group-hover:opacity-100 group-hover:border-slate-700">
                        </a>
                    </div>
                </form>
            </div>
            <div class="w-1/2 bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
                wk
            </div>
        </div>

    </div>

</body>

</html>
