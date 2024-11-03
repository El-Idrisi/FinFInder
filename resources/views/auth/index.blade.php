@extends('layouts.auth')

@section('content')
    <div class="flex w-full h-full lg:h-fit shadow-manual ">
        <div class="w-full px-6 py-12 pb-24 lg:px-16 lg:w-1/2 bg-slate-100">
            <div class="flex flex-col justify-center h-full form-container ">
                <h2 class="text-4xl text-center lg:text-start">SIGN IN</h2>
                <form action="{{ route('login.submit') }}" method="POST" class="mt-4 ">
                    @csrf

                    <div class="flex flex-col my-8">
                        <label for="login" class="mb-2 text-lg font-bold">Username atau Email</label>
                        <input type="text" name="login" id="login" placeholder="Username atau Email"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                            autocomplete="off">
                    </div>


                    <div class="flex flex-col my-8">
                        <label for="password" class="mb-2 text-lg font-bold">Password</label>
                        <div class="bg-[#e9e9e9] rounded-full flex items-center pass">
                            <input type="password" name="password" id="password" placeholder="password"
                                class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none " data-pass="password">
                            <a href="#" class="flex items-center" onclick="showPassword('password')">
                                <i id="eye-icon-password" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
                            </a>
                        </div>
                    </div>

                    @error('login')
                        <p class="text-center text-red-500">{{ $message }}</p>
                    @enderror
                    @error('password')
                        <p class="text-center text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">Login
                    </button>

                    <div class="flex flex-col justify-center gap-4 my-4 md:justify-between md:flex-row">
                        <div class="flex items-center justify-center">
                            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 checked:accent-sky-500">
                            <label for="remember" class="ml-2 text-lg text-slate-900">Remember Me</label>
                        </div>
                        <a href="/forgot-password"
                            class="flex flex-col items-center justify-center text-slate-500 hover:text-slate-700 group">
                            Forget Password
                            <hr
                                class="hidden w-0 transition-all duration-300 opacity-0 lg:block group-hover:w-full group-hover:opacity-100 group-hover:border-slate-700">
                        </a>
                    </div>
                </form>
            </div>
            <p class="absolute left-0 w-full text-center bottom-10 lg:hidden">Need an Account <a href="/register"
                    class="text-sky-500">Register Here</a></p>
        </div>
        <div class="lg:w-1/2 w-0 hidden lg:block bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
            <div class="flex flex-col items-center justify-center h-full gap-8 text-slate-100">
                <h3 class="text-5xl font-bold text-center">Welcome To Login</h3>
                <p class="text-xl">Need an Account</p>
                <a href="/register"
                    class="px-4 py-2 transition-all duration-500 border-2 rounded-full border-slate-100 bg-size-200 bg-gradient-to-r from-sky-600 via-sky-500 to-sky-300 bg-pos-100 hover:bg-pos-0">Register
                    Here</a>
            </div>
        </div>
    </div>
@endsection




