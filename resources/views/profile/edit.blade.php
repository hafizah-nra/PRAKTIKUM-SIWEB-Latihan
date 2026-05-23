@extends('layouts.main')

@section('title', 'Profil Saya – TumblrVault')

@section('content')
<div class="tambah-header" style="padding-top: 120px;">
  <div class="container">
    <div class="d-flex align-items-center gap-3 mb-3">
      <a href="{{ route('dashboard') }}" class="back-btn">
        <i class="bi bi-arrow-left me-1"></i>Kembali
      </a>
      <span class="breadcrumb-sep">/</span>
      <span class="breadcrumb-cur">Profil Saya</span>
    </div>
    <h1 class="tambah-title">Pengaturan Profil</h1>
    <p class="tambah-desc">Perbarui informasi dasar profil dan pengaturan akun Anda.</p>
  </div>
</div>

<section class="tambah-body py-5">
  <div class="container">
    <div class="row justify-content-center g-4">
      <div class="col-lg-8">
        
        <!-- Update Profile Information -->
        <div class="form-card mb-4">
            <div class="form-section-title"><i class="bi bi-person me-2"></i>Informasi Profil</div>
            
            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="mb-4">
                    <label class="form-label-custom">Foto Profil</label>
                    <div class="d-flex align-items-center gap-3">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Avatar" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 80px; height: 80px; background-color: var(--dusty); font-size: 2rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <input class="form-control form-control-sm" type="file" name="profile_photo" accept="image/jpeg,image/png,image/jpg">
                            <small class="text-muted">Format: JPG, PNG, ukuran maksimal 2MB.</small>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label-custom">Nama Lengkap</label>
                    <input type="text" class="form-control form-control-custom" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label-custom">Alamat Email</label>
                    <input type="email" class="form-control form-control-custom" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary-custom">Simpan Perubahan</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success small fw-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>

        <!-- Update Password -->
        <div class="form-card mb-4">
            <div class="form-section-title"><i class="bi bi-shield-lock me-2"></i>Perbarui Password</div>
            
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="update_password_current_password" class="form-label-custom">Password Saat Ini</label>
                    <input type="password" class="form-control form-control-custom" id="update_password_current_password" name="current_password" autocomplete="current-password">
                </div>

                <div class="mb-3">
                    <label for="update_password_password" class="form-label-custom">Password Baru</label>
                    <input type="password" class="form-control form-control-custom" id="update_password_password" name="password" autocomplete="new-password">
                </div>

                <div class="mb-4">
                    <label for="update_password_password_confirmation" class="form-label-custom">Konfirmasi Password</label>
                    <input type="password" class="form-control form-control-custom" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                </div>

                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary-custom">Ubah Password</button>
                    @if (session('status') === 'password-updated')
                        <span class="text-success small fw-medium" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection
