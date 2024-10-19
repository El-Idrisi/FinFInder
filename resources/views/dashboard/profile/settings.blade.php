@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col gap-12">
        <x-form-group title="Update Profile">
            <form action="{{ route('update.profile') }}" method="POST" class="px-8 py-6">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap gap-12 lg:flex-nowrap ">
                    <x-input-form value="{{ $user->username }}" title="Username" id="username"
                        tipe="text"></x-input-form>

                    <x-input-form value="{{ $user->nama }}" title="Nama" id="nama"
                        tipe="text"></x-input-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-form value="{{ $user->no_telp }}" title="Nomor Telephone" id="no_telp"
                        tipe='tel'></x-input-form>

                    <x-input-form value="{{ $user->tanggal_lahir }}" title="Tanggal Lahir" id="tanggal_lahir"
                        tipe='date'></x-input-form>
                </div>

                <div class="flex flex-col mt-8">
                    <label for="alamat" class="mb-2 font-bold">Alamat</label>
                    <textarea name="alamat" id="alamat" placeholder="Alamat" rows="3"
                        class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500">{{ $user->alamat }}</textarea>
                    @error('alamat')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <x-btn-submit tipe="submit" id="updateProfile">Update Profile</x-btn-submit>
            </form>
        </x-form-group>

        <x-form-group title="Ganti Email">
            <form class="px-8 py-6" id="changeEmailForm">
                <p>Untuk mengganti email akun Anda, masukkan password Anda dan email baru (<i>@gmail.com</i>) yang
                    diinginkan, lalu klik 'Kirim Kode Verifikasi'. Kami akan mengirim kode ke email baru tersebut.
                    Pastikan Anda memiliki akses ke email baru ini untuk menyelesaikan proses perubahan.</p>

                @csrf

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-password-form id="password" title="Password"></x-input-password-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-form id="new_email" title="New Email" tipe="email" value=""></x-input-form>
                </div>

                <x-btn-submit tipe="button" id="sendVerificationCode">Kirim Kode Verifikasi</x-btn-submit>


                <div id="verificationSection" style="display: none;">

                    <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                        <x-input-form id="verification_code" title="Kode Verifikasi" tipe="text" value=""></x-input-form>
                    </div>

                    <x-btn-submit tipe="button" id="verifyCode">Verifikasi Kode</x-btn-submit>
                </div>

                <div id="message" style="display: none"
                    class="px-4 py-2 mt-4 border-2 rounded-md border-sky-500 bg-sky-200">
                </div>

                <div id="loadingIndicator" style="display: none;">
                    <span class="spinner animate-spin"></span> Mengirim kode verifikasi...
                </div>

            </form>
        </x-form-group>

        <x-form-group title="Ganti Password">
            <form action="{{ route('update.profile') }}" method="POST" class="px-8 py-6">
                @csrf

                <div class="flex flex-wrap gap-12 lg:flex-nowrap">
                    <x-input-password-form id="current_password" title="Password Sekarang"></x-input-password-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-password-form id="new_password" title="Password Baru"></x-input-password-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-password-form id="confirm_password" title="Konfirmasi Password"></x-input-password-form>
                </div>

                <x-btn-submit tipe="button" id="UpdatePassword">Update Password</x-btn-submit>
            </form>
        </x-form-group>

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
