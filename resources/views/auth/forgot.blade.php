@extends('layouts.auth')

@section('content')
    <div class="flex w-full h-full lg:h-fit shadow-manual ">
        <div class="w-full px-6 py-12 pb-24 lg:px-16 lg:w-1/2 bg-slate-100">
            <div class="flex flex-col justify-center h-full form-container ">
                <h2 class="text-4xl text-center lg:text-start">FORGOT PASSWORD</h2>
                <form action="{{ route('forgoPassword.send') }}" method="POST" class="mt-4 ">
                    @csrf

                    <p>Masukkan email yang terkait dengan akun Anda dan kami akan mengirimkan instruksi email untuk mengatur ulang kata sandi Anda</p>

                    <div class="flex flex-col my-8">
                        <label for="email" class="mb-2 text-lg font-bold">Email</label>
                        <input type="email" name="email" id="email" placeholder="email"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                            autocomplete="off">
                    </div>

                    @error('email')
                        <p class="text-red-500 t">{{ $message }}</p>
                    @enderror


                    <button type="submit"
                        class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">Send</button>
                </form>
            </div>
            <p class="absolute left-0 w-full text-center bottom-10 lg:hidden">Need an Account <a href="/register"
                    class="text-sky-500">Register Here</a></p>
        </div>
        <div class="lg:w-1/2 w-0 hidden lg:block bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
            <div class="flex flex-col items-center justify-center h-full gap-8 text-slate-100">
                <h3 class="text-5xl font-bold text-center">Back To Login</h3>
                <p class="text-xl">Already remembered the password</p>
                <a href="/login"
                    class="px-4 py-2 transition-all duration-500 border-2 rounded-full border-slate-100 bg-size-200 bg-gradient-to-r from-sky-600 via-sky-500 to-sky-300 bg-pos-100 hover:bg-pos-0">Login
                    Here</a>
            </div>
        </div>
    </div>
@endsection
