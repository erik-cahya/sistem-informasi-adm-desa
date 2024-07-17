     @extends('layouts.auth')
     @section('content')
         <div class="justify-content-center pt-4">
             <div class="logo d-flex flex-column align-items-center w-auto">
                 <span class="text-center">Sistem Informasi Administrasi</span>
                 <span class="text-center">Desa Rantau Puri</span>
             </div>
         </div><!-- End Logo -->

         <div class="">
             <hr class="mb-0">
             <h5 class="card-title text-center pb-0 fs-4 mt-0">Login</h5>
             <p class="text-center small">Masukan username & password</p>
         </div>

         <form class="row g-3 needs-validation" method="POST" action="{{ url('login') }}" novalidate>
             @csrf
             @include('includes.flash-message')
             <div class="col-12">
                 <label for="yourUsername" class="form-label"><b>Username</b></label>
                 <div class="input-group has-validation">
                     <input type="text" name="username" class="form-control" id="yourUsername" required>
                     <div class="invalid-feedback">Masukan username anda.</div>
                 </div>
             </div>

             <div class="col-12">
                 <label for="yourPassword" class="form-label"><b>Password</b></label>
                 <input type="password" name="password" class="form-control" id="yourPassword" required>
                 <div class="invalid-feedback">Masukan password anda!</div>
             </div>

             <div class="col-12">
                 <p class="small mb-0">Lupa password? <a href="{{ route('forget.password.get') }}">Klik disini</a></p>
             </div>

             <div class="col-12">
                 <button class="btn btn-primary btn-lg w-100" type="submit">Masuk
                 </button>
             </div>
             <div class="col-12">
                 <a href="/register" class="btn btn-danger btn-lg w-100" type="submit">Register</a>
                 </button>
             </div>

             <div class="col-12">
                 <p class="small mb-0">Kembali Ke Beranda <a href="/beranda">Klik disini</a></p>
             </div>

         </form>
     @endsection
