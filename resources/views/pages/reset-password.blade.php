@extends('layouts.auth')
@section('content')
    <div class="">
        <h5 class="card-title text-center pb-0 fs-4 mt-0">Reset password</h5>
        <p class="text-center small">Masukan password baru anda</p>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="{{ route('reset.password.post') }}" novalidate>
        @csrf
        @include('includes.flash-message')

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="col-12">
            <label for="password" class="form-label"><b>Password baru</b></label>
            <div class="input-group has-validation">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <label for="ulang_password_baru" class="form-label"><b>Ulangi password baru</b></label>
            <div class="input-group has-validation">
                <input type="password" name="ulang_password_baru" class="form-control @error('ulang_password_baru') is-invalid @enderror" id="ulang_password_baru">
                @error('ulang_password_baru')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary btn-lg w-100" type="submit">Reset password
            </button>
        </div>
        
    </form>
@endsection
