@extends('layouts.blank')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link href="https://fonts.cdnfonts.com/css/dash-horizon" rel="stylesheet">
<style>
    .custom-btn {
        background-color: #8174A0;
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
    }

    .custom-btn:hover {
        background-color: #7c5c99;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(152, 131, 163, 0.25);
        border-color: #8174A0;
    }

    .btn-outline-danger:hover {
        background-color: #DB4437;
        color: #fff !important;
        border-color: #c03b30;
    }

    .btn-outline-danger {
        transition: all 0.3s ease;
    }

    .register-wrapper {
        display: flex;
        height: 100vh;
    }

    .register-left {
        width: 50%;
        height: 100%;
        overflow: hidden;
    }

    .register-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .register-right {
        width: 50%;
    }

    @media (max-width: 768px) {
        .register-wrapper {
            flex-direction: column;
        }

        .register-left,
        .register-right {
            width: 100% !important;
            height: 50vh;
        }

        .register-left img {
            height: 100%;
        }
    }
    .password-toggle-btn {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        cursor: pointer;
        color: #8174A0;
        font-size: 1.1rem;
        padding: 0;
        line-height: 1;
    }
    .password-toggle-btn:focus {
        outline: none;
        color: #5a4e7c;
    }
</style>
@endsection

@section('content')
<div class="register-wrapper">
    <!-- Left Side: Full Background Image -->
    <div class="register-left bg-dark">
        <img src="{{ asset('assets/img/Ataraxia.jpg') }}" alt="Logo">
    </div>

    <!-- Right Side: Register Form -->
    <div class="d-flex flex-column justify-content-center align-items-center bg-white register-right px-3 py-5">
        <div class="w-100" style="max-width: 400px;">
            <h3 class="text-center fw-bold mb-4">Register</h3>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <input type="text" name="name" class="form-control rounded-pill @error('name') is-invalid @enderror" placeholder="Nama" value="{{ old('name') }}" required autofocus>
                    @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control rounded-pill @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required>
                    @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <input type="text" name="phone" class="form-control rounded-pill @error('phone') is-invalid @enderror" placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
                    @error('phone')<span class="text-danger small">{{ $message }}</span>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label d-block text-muted">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderLaki" value="laki-laki" {{ old('gender') == 'laki-laki' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="genderLaki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="genderPerempuan" value="perempuan" {{ old('gender') == 'perempuan' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="genderPerempuan">Perempuan</label>
                    </div>
                    @error('gender')<div><span class="text-danger small">{{ $message }}</span></div>@enderror
                </div>

            <div class="mb-3 position-relative">
    <input type="password" name="password" id="password" class="form-control rounded-pill @error('password') is-invalid @enderror" placeholder="Password" autocomplete="new-password" required>
    <button type="button" class="password-toggle-btn" onclick="togglePassword('password', this)">
       <i class="fas fa-eye-slash"></i>
    </button>
    @error('password')<span class="text-danger small">{{ $message }}</span>@enderror
</div>

<div class="mb-3 position-relative">
    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-pill" placeholder="Konfirmasi Password" required>
    <button type="button" class="password-toggle-btn" onclick="togglePassword('password_confirmation', this)">
       <i class="fas fa-eye-slash"></i>
    </button>
</div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn text-white fw-bold rounded-pill custom-btn">
                        Daftar
                    </button>
                </div>

                <div class="text-center">
                    <span class="text-muted small">Sudah punya akun? </span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold small" style="color: #8174A0;">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon = btn.querySelector('i');

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        input.type = "password";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
</script>
@endsection

