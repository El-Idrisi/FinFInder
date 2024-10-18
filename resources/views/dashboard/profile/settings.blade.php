@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col gap-12">
        <div class="w-full bg-white rounded-lg shadow">
            <div
                class="text-white transition-all duration-300 rounded-t-lg cursor-pointer bg-sky-800 accordion hover:bg-sky-700">
                <h4 class="px-4 py-2 font-bold">Profile</h4>
            </div>
            <div class="overflow-hidden accor active">
                <form action="{{ route('update.profile') }}" method="POST" class="px-8 py-6">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap gap-12 lg:flex-nowrap ">
                        <div class="flex flex-col w-full">
                            <label for="username" class="mb-2 font-bold">Username</label>
                            <input type="text" name="username" id="username"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Username" autocomplete="off" value="{{ $user->username }}">
                            @error('username')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="nama" class="mb-2 font-bold">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Nama" autocomplete="off" value="{{ $user->nama }}">
                            @error('nama')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                        <div class="flex flex-col w-full">
                            <label for="no.telp" class="mb-2 font-bold">Nomor Telephone</label>
                            <input type="tel" name="no.telp" id="no.telp"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="No.Telp" value="{{ $user->no_telp }}">
                            @error('no_telp')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="tanggal_lahir" class="mb-2 font-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Tanggal Lahir" value="{{ $user->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col mt-8">
                        <label for="alamat" class="mb-2 font-bold">Alamat</label>
                        <textarea name="alamat" id="alamat" placeholder="Alamat" rows="3"
                            class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500">{{ $user->alamat }}</textarea>
                        @error('alamat')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="px-4 py-2 mt-8 font-bold text-white transition-all duration-300 rounded-lg bg-sky-500 hover:bg-sky-600">Update
                        Profile</button>
                </form>
            </div>
            <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
        </div>

        <div class="w-full bg-white rounded-lg shadow">
            <div
                class="text-white transition-all duration-300 rounded-t-lg cursor-pointer bg-sky-800 accordion hover:bg-sky-700">
                <h4 class="px-4 py-2 font-bold">Ganti Email</h4>
            </div>
            <div class="overflow-hidden accor active">
                <form class="px-8 py-6" id="changeEmailForm">
                    <p>Untuk mengganti email akun Anda, masukkan password Anda dan email baru (<i>@gmail.com</i>) yang
                        diinginkan, lalu klik 'Kirim Kode Verifikasi'. Kami akan mengirim kode ke email baru tersebut.
                        Pastikan Anda memiliki akses ke email baru ini untuk menyelesaikan proses perubahan.</p>

                    @csrf

                    <div class="flex flex-col w-full mt-8">
                        <label for="password" class="mb-2 font-bold">Password</label>
                        <div class="">
                            <div
                                class="flex items-center border-2 rounded-md pass outline-2 border-slate-400 focus:outline-sky-500">
                                <input type="password" name="password" id="password" placeholder="Password"
                                    class="w-full px-4 py-3 bg-transparent rounded-full focus:outline-none ">
                                <button type="button" href="#" class="flex items-center"
                                    onclick="showPassword('password')">
                                    <i id="eye-icon-password" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mt-8">
                        <label for="new_email" class="mb-2 font-bold">New Email</label>
                        <input type="email" name="new_email" id="new_email"
                            class="px-4 py-3 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                            placeholder="New Email" autocomplete="off">
                        @error('email')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="button"
                        class="px-4 py-2 mt-8 font-bold text-white transition-all duration-300 rounded-lg bg-sky-500 hover:bg-sky-600"
                        id="sendVerificationCode">Kirim Kode Verifikasi</button>

                    <div id="verificationSection" style="display: none;">
                        <div class="flex flex-col w-full mt-8">

                            <label for="verification_code" class="mb-2 font-bold">Kode Verifikasi</label>
                            <input type="text" name="verification_code" id="verification_code"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Kode Verifikasi" autocomplete="off">
                            @error('verification_code')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="button"
                            class="px-4 py-2 mt-8 font-bold text-white transition-all duration-300 rounded-lg bg-sky-500 hover:bg-sky-600"
                            id="verifyCode">Verifikasi Kode</button>
                    </div>

                    <div id="message" style="display: none"
                        class="px-4 py-2 mt-4 border-2 rounded-md border-sky-500 bg-sky-200">
                    </div>

                    <div id="loadingIndicator" style="display: none;">
                        <span class="spinner animate-spin"></span> Mengirim kode verifikasi...
                    </div>

                </form>
            </div>
            <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
        </div>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sendVerificationCodeBtn = document.getElementById('sendVerificationCode');
                const verifyCodeBtn = document.getElementById('verifyCode');
                const messageDiv = document.getElementById('message');
                const verificationSection = document.getElementById('verificationSection');

                // Tambahkan elemen loading
                const loadingIndicator = document.createElement('div');
                loadingIndicator.id = 'loadingIndicator';
                loadingIndicator.innerHTML = '<span class="spinner"></span> Mengirim...';
                loadingIndicator.style.display = 'none';
                document.body.appendChild(loadingIndicator);

                function showLoading(show) {
                    loadingIndicator.style.display = show ? 'block' : 'none';
                    sendVerificationCodeBtn.disabled = show;
                }

                sendVerificationCodeBtn.addEventListener('click', function() {
                    const password = document.getElementById('password').value;
                    const newEmail = document.getElementById('new_email').value;

                    showLoading(true);

                    axios.post('/send-verification-code', {
                            password: password,
                            new_email: newEmail
                        })
                        .then(function(response) {
                            showLoading(false);
                            verificationSection.style.display = 'block';
                            messageDiv.style.display = 'block';
                            messageDiv.innerHTML = 'Kode verifikasi telah dikirim ke email baru Anda.';
                        })
                        .catch(function(error) {
                            showLoading(false);
                            messageDiv.style.display = 'block';
                            messageDiv.innerHTML = error.response.data.message;
                        });
                });

                verifyCodeBtn.addEventListener('click', function() {
                    const code = document.getElementById('verification_code').value;
                    const newEmail = document.getElementById('new_email').value;

                    showLoading(true);

                    axios.post('/verify-email-change', {
                            verification_code: code,
                            new_email: newEmail
                        })
                        .then(function(response) {
                            showLoading(false);
                            messageDiv.innerHTML = 'Email berhasil diubah.';
                        })
                        .catch(function(error) {
                            showLoading(false);
                            messageDiv.innerHTML = error.response.data.message;
                        });
                });
            });

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
    @endpush
@endsection
