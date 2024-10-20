@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col gap-12">
        <x-form-group title="Update Profile" :isDelete="false">
            <form action="{{ route('update.profile') }}" method="POST" class="px-8 py-6">
                @csrf
                @method('PUT')
                <div class="flex flex-wrap gap-12 lg:flex-nowrap ">
                    <x-input-form value="{{ $user->username }}" title="Username" id="username" tipe="text"></x-input-form>

                    <x-input-form value="{{ $user->nama }}" title="Nama" id="nama" tipe="text"></x-input-form>
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

        <x-form-group title="Ganti Email" :isDelete="false">
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
                        <x-input-form id="verification_code" title="Kode Verifikasi" tipe="text"
                            value=""></x-input-form>
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

        <x-form-group title="Ganti Password" :isDelete="false">
            <form class="px-8 py-6">
                @csrf

                <div id="message-pass" class="px-4 py-2 mb-8 border-2 rounded-md bg-sky-200 border-sky-500"
                    style="display: none">
                    Password Berhasil di Ganti
                </div>

                <div class="flex flex-wrap gap-12 lg:flex-nowrap">
                    <x-input-password-form id="current_password" title="Password Sekarang"></x-input-password-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-password-form id="new_password" title="Password Baru"></x-input-password-form>
                </div>

                <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                    <x-input-password-form id="new_password_confirmation"
                        title="Konfirmasi Password"></x-input-password-form>
                </div>

                <x-btn-submit tipe="button" id="UpdatePassword">Update Password</x-btn-submit>
            </form>
        </x-form-group>

        <x-form-group title="Hapus Akun" :isDelete="true">
            <h5 class="p-4 font-bold text-center">Setelah Anda menghapus akun Anda, tidak ada jalan untuk kembali. Harap
                pastikan kembali keputusan Anda.</h5>

            <div class="px-12 pb-8">
                <button type="button"
                    class="w-full py-2 font-bold text-white transition-all duration-300 bg-red-600 rounded-md hover:bg-red-500"
                    id="delete_account">Hapus Akun</button>
            </div>
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

                const password = document.getElementById('password');
                const code = document.getElementById('verification_code');
                const newEmail = document.getElementById('new_email');

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



                function showMessage(element, message, isSuccess, isPass) {
                    element.style.display = 'block';
                    element.textContent = message;
                    element.className = `px-4 py-2 border-2 rounded-md ${
                        isSuccess ? 'bg-green-200 border-green-500' : 'bg-red-200 border-red-500'
                    }`;
                    element.classList.add(`${
                        isPass ? 'mb-8' : 'mt-8'
                    }`)
                }

                function resetForm(...inputs) {
                    inputs.forEach(input => input.value = '');
                }

                sendVerificationCodeBtn.addEventListener('click', function() {

                    showLoading(true);

                    axios.post('/send-verification-code', {
                            password: password.value,
                            new_email: newEmail.value
                        })
                        .then(function(response) {
                            showLoading(false);
                            verificationSection.style.display = 'block';
                            showMessage(messageDiv, 'Kode verifikasi telah dikirim ke email baru Anda.',
                                true, false);
                        })
                        .catch(function(error) {
                            showLoading(false);
                            showMessage(messageDiv, error.response.data.message, false, false);
                        });
                });

                verifyCodeBtn.addEventListener('click', function() {

                    showLoading(true);

                    axios.post('/verify-email-change', {
                            verification_code: code.value,
                            new_email: newEmail.value
                        })
                        .then(function(response) {
                            showLoading(false);
                            resetForm(code, newEmail, password);
                            verificationSection.style.display = 'none';
                            showMessage(messageDiv, 'Email berhasil diubah.', true, false);
                        })
                        .catch(function(error) {
                            showLoading(false);
                            showMessage(messageDiv, error.response.data.message, false, false);
                        });
                });

                const updatePasswordBtn = document.getElementById('UpdatePassword');
                const messagePass = document.getElementById('message-pass');
                const currentPassword = document.getElementById('current_password');
                const newPassword = document.getElementById('new_password');
                const newPasswordConfirmation = document.getElementById('new_password_confirmation');

                updatePasswordBtn.addEventListener('click', function() {
                    axios.post('/change-password', {
                            current_password: currentPassword.value,
                            new_password: newPassword.value,
                            new_password_confirmation: newPasswordConfirmation.value
                        })
                        .then(function(response) {
                            showMessage(messagePass, response.data.message, true, true);
                            resetForm(currentPassword, newPassword, newPasswordConfirmation);
                        })
                        .catch(function(error) {
                            showMessage(messagePass, error.response.data.message || 'Terjadi kesalahan',
                                false, true);
                        });
                });

                const deleteAccount = document.getElementById('delete_account');

                deleteAccount.addEventListener('click', function() {
                    Swal.fire({
                        title: 'Hapus Akun',
                        input: 'password',
                        inputAttributes: {
                            autocapitalize: 'off',
                            autocorrect: 'off'
                        },
                        inputPlaceholder: 'Masukkan password Anda',
                        showCancelButton: true,
                        confirmButtonText: 'Hapus Akun',
                        cancelButtonText: 'Batal',
                        showLoaderOnConfirm: true,
                        preConfirm: (password) => {
                            return axios.post('/delete-account', {
                                    password: password
                                })
                                .then(response => {
                                    if (response.data.success) {
                                        return response.data.message;
                                    }
                                    throw new Error(response.data.message ||
                                        'Terjadi kesalahan');
                                })
                                .catch(error => {
                                    Swal.showValidationMessage(
                                        `${error.response.data.message || error.message}`
                                    );
                                });
                        },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: result.value,
                                icon: 'success'
                            }).then(() => {
                                // Redirect ke halaman login atau home setelah akun dihapus
                                window.location.href = '/login';
                            });
                        }
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
