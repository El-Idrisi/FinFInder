@extends('layouts.auth')

@section('content')
    {{-- resources/views/auth/register-step2.blade.php --}}
    <div class="flex flex-row-reverse w-full h-full lg:h-fit shadow-manual">
        <div class="w-full px-6 py-32 lg:px-16 lg:w-1/2 bg-slate-100">
            <div class="flex flex-col justify-center h-full form-container">
                <h2 class="text-4xl text-center lg:text-start">TAHAP-2 | DAFTAR</h2>
                <form action="{{ route('register.step2.process') }}" method="POST" class="mt-4">
                    @csrf
                    <p class="my-4">Masukkan kode verifikasi yang sudah kami kirim ke email Anda.</p>

                    {{-- Modified resend link with container for check icon --}}
                    <div class="flex items-center gap-2">
                        <button type="button" id="resend-verification"
                            class="transition-all duration-300 text-sky-500 hover:underline hover:text-sky-600">
                            Kirim Ulang
                        </button>
                        <div role="status" id="loading" class="hidden">
                            <svg aria-hidden="true"
                                class="w-8 h-8 text-gray-300 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span id="resend-success" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <span id="resend-timer" class="text-sm text-gray-500"></span>
                    </div>

                    <input type="hidden" name="email" id="email" value="{{ $email }}">
                    <div class="flex flex-col my-2">
                        <label for="verification_code" class="mb-1 text-lg font-bold">Kode Verifikasi</label>
                        <input type="text" name="verification_code" id="verification_code" placeholder="kode verifikasi"
                            class="px-4 py-3 rounded-full bg-[#e9e9e9] focus:outline outline-none focus:outline-sky-500"
                            autocomplete="off">
                    </div>
                    @error('verification_code')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="w-full py-2 my-4 text-lg font-bold transition-all duration-500 rounded-full bg-gradient-to-r from-sky-600 via-sky-400 to-sky-600 bg-pos-100 bg-size-200 text-slate-100 hover:bg-pos-0">
                        Verifikasi Kode
                    </button>
                </form>
            </div>
            <p class="absolute left-0 w-full text-center bottom-10 lg:hidden">
                Sudah Punya Akun, <a href="/login" class="text-sky-500">Login Here</a>
            </p>
        </div>
        <div class="lg:w-1/2 w-0 hidden lg:block bg-gradient-to-r from-sky-300 via-sky-500 via-55% to-blue-500">
            <div class="flex flex-col items-center justify-center h-full gap-8 px-20 text-slate-100">
                <h3 class="text-5xl font-bold text-center">Selamat Datang di Halaman Pendaftaran.</h3>
                <p class="text-xl">Sudah Memiliki Akun.</p>
                <a href="/login"
                    class="px-4 py-2 transition-all duration-500 border-2 rounded-full border-slate-100 bg-size-200 bg-gradient-to-r from-sky-600 via-sky-500 to-sky-300 bg-pos-100 hover:bg-pos-0">Masuk
                    Di Sini!</a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // public/js/verification.js
        document.addEventListener('DOMContentLoaded', function() {
            const resendButton = document.getElementById('resend-verification');
            const resendSuccess = document.getElementById('resend-success');
            const resendTimer = document.getElementById('resend-timer');
            const loadingSpinner = document.getElementById('loading');
            const email = document.getElementById('email').value;

            const resendUrl = "{{ route('register.verification.resend') }}";

            if (resendButton) {
                let timer;
                const cooldownPeriod = 60; // Cooldown in seconds

                resendButton.addEventListener('click', async function() {
                    // Disable the button immediately
                    resendButton.disabled = true;
                    resendSuccess.classList.add('hidden');

                    try {
                        // Show loading spinner
                        loadingSpinner.classList.remove('hidden');
                        // Menggunakan URL dari Laravel route helper
                        const response = await axios.post(resendUrl, {
                            email: email,
                            _token: document.querySelector('meta[name="csrf-token"]')
                                .content // Tambahkan CSRF token
                        });

                        if (response.data.success) {
                            // Hide loading spinner
                            loadingSpinner.classList.add('hidden');
                            // Show success message and check icon
                            Swal.fire({
                                icon: 'success',
                                title: 'Kode Terkirim!',
                                text: response.data.message,
                                timer: 3000,
                                timerProgressBar: true,
                                showConfirmButton: false
                            });

                            // Show check icon
                            resendSuccess.classList.remove('hidden');

                            // Start cooldown timer
                            let timeLeft = cooldownPeriod;
                            resendTimer.textContent = `(${timeLeft}s)`;

                            timer = setInterval(() => {
                                timeLeft--;
                                if (timeLeft <= 0) {
                                    clearInterval(timer);
                                    resendButton.disabled = false;
                                    resendTimer.textContent = '';
                                    resendSuccess.classList.add('hidden');
                                } else {
                                    resendTimer.textContent = `(${timeLeft}s)`;
                                }
                            }, 1000);
                        }
                    } catch (error) {
                        // Hide loading spinner
                        loadingSpinner.classList.add('hidden');

                        console.error('Error details:', error); // Tambahan untuk debugging

                        // Handle different types of errors
                        let errorMessage = 'Terjadi kesalahan. Silakan coba lagi nanti.';

                        if (error.response) {
                            errorMessage = error.response.data.message || errorMessage;
                            console.log('Error response:', error.response); // Tambahan untuk debugging
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengirim Kode',
                            text: errorMessage
                        });

                        // Enable the button again if there's an error
                        resendButton.disabled = false;
                        resendTimer.textContent = '';
                        resendSuccess.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endpush
