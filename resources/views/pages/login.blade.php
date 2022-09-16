     @extends('layouts.auth')
     @section('content')
         <div class="">
             <hr class="mb-0">
             <h5 class="card-title text-center pb-0 fs-4 mt-0">Login</h5>
             <p class="text-center small">Masukan username & password</p>
         </div>

         <form class="row g-3 needs-validation" method="POST" action="{{ url('login') }}" novalidate>
             @csrf
             @include('includes.flash-message')
             <div class="col-12">
                 <label for="yourUsername" class="form-label">Username</label>
                 <div class="input-group has-validation">
                     <input type="text" name="username" class="form-control" id="yourUsername" required>
                     <div class="invalid-feedback">Masukan username anda.</div>
                 </div>
             </div>

             <div class="col-12">
                 <label for="yourPassword" class="form-label">Password</label>
                 <input type="password" name="password" class="form-control" id="yourPassword" required>
                 <div class="invalid-feedback">Masukan password anda!</div>
             </div>

             <div class="col-12">
                 <div class="form-check">
                     <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                     <label class="form-check-label" for="rememberMe">Remember me</label>
                 </div>
             </div>
             <div class="col-12">
                 <button class="btn btn-primary w-100" type="submit">Login</button>
             </div>
             {{-- <div class="col-12">
                 <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
             </div> --}}
         </form>
     @endsection
