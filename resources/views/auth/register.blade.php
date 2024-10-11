@extends('layouts.auth')

@section('content')
    <div class="flex flex-row-reverse w-full h-full lg:h-fit shadow-manual">
        <div class="w-full px-6 py-10 lg:px-16 lg:w-1/2 bg-slate-100">
            <div class="flex flex-col justify-center h-full form-container ">
                <h2 class="text-4xl text-center lg:text-start">SIGN UP</h2>
                <form action="{{ route('register.submit') }}" method="POST" class="mt-4 ">
                    @csrf

                    <div class="flex flex-col my-2">
                        <label for="username" class="mb-1 text-lg font-bold ">Username</label>
                        <input type="text" name="username" id="username" placeholder="username"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                            autocomplete="off">
                    </div>
                    @error('username')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex flex-col my-2">
                        <label for="email" class="mb-1 text-lg font-bold ">Email</label>
                        <input type="email" name="email" id="email" placeholder="email"
                        class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                        autocomplete="off">
                    </div>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror


                    <div class="flex flex-col my-2">
                        <label for="password" class="mb-1 text-lg font-bold ">Password</label>
                        <div class="bg-[#e9e9e9] rounded-full flex items-center pass">
                            <input type="password" name="password" id="password" placeholder="password"
                            class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none ">
                            <a href="#" class="flex items-center" onclick="showPassword('password')">
                                <i id="eye-icon-password" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
                            </a>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div class="flex flex-col my-2">
                        <label for="password_confirmation" class="mb-1 text-lg font-bold ">Confirm Password</label>
                        <div class="bg-[#e9e9e9] rounded-full flex items-center pass-confirm">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm Password"
                                class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none ">
                            <a href="#" class="flex items-center" onclick="showPassword('password_confirmation')">
                                <i id="eye-icon-password_confirmation" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
                            </a>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">Register</button>


                </form>
            </div>
            <p class="absolute left-0 w-full text-center bottom-10 lg:hidden">Sudah Punya Akun, <a href="/login"
                    class="text-sky-500">Login Here</a></p>
        </div>
        <div class="lg:w-1/2 w-0 hidden lg:block bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
            <div class="flex flex-col items-center justify-center h-full gap-8 text-slate-100">
                <h3 class="text-5xl font-bold text-center">Welcome To Sign Up</h3>
                <p class="text-xl">Already have an account</p>
                <a href="/login"
                    class="px-4 py-2 transition-all duration-500 border-2 rounded-full border-slate-100 bg-size-200 bg-gradient-to-r from-sky-600 via-sky-500 to-sky-300 bg-pos-100 hover:bg-pos-0">Login
                    Here</a>
            </div>
        </div>
    </div>
@endsection