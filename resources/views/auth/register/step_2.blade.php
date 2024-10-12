@extends('layouts.auth')

@section('content')
    <div class="flex flex-row-reverse w-full h-full lg:h-fit shadow-manual">
        <div class="w-full px-6 py-32 lg:px-16 lg:w-1/2 bg-slate-100">
            <div class="flex flex-col justify-center h-full form-container ">
                <h2 class="text-4xl text-center lg:text-start">STEP-2 | SIGN UP</h2>
                <form action="{{ route('register.step2.process') }}" method="POST" class="mt-4 ">
                    @csrf
                    <p class="my-4">Masukan kode verifikasi yang dikirim ke email yang Anda input.
                    </p>
                    <input type="hidden" name="email" id="email" value="{{ $email }}">
                    <div class="flex flex-col my-2">
                        <label for="verification_code" class="mb-1 text-lg font-bold ">Kode Verifikasi</label>
                        <input type="text" name="verification_code" id="verification_code" placeholder="kode verifikasi"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                            autocomplete="off">
                    </div>
                    @error('verification_code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror


                    <button type="submit"
                        class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">Verifikasi Kode</button>


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
