@extends('layouts.auth')
@section('content')
    <div class="">
        <h5 class="card-title text-center pb-0 fs-4 mt-0">Lupa password</h5>
        <p class="text-center small">Masukan Email anda, kami akan mengirimkan link untuk mengatur ulang password anda</p>
    </div>

    <form class="row g-3 needs-validation" method="POST" action="{{ route('forget.password.post') }}" novalidate>
        @csrf
        @include('includes.flash-message')
        <div class="col-12">
            <label for="email" class="form-label"><b>Email</b></label>
            <div class="input-group has-validation">
                <input type="email" name="email" class="form-control" id="email" required>
                <div class="invalid-feedback">Masukan email anda.</div>
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary btn-lg w-100" type="submit">Kirim link reset password
            </button>
        </div>
        
    <div class="col-12">
            <p class="small mb-0">Kembali ke halaman login? <a href="{{route('login')}}">klik disini</a></p>
    </div>
    </form>
@endsection
