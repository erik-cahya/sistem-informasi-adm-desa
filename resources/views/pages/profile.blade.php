  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Pengaturan</li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-6 col-md-12 col-sm-12">
                  <div class="card">
                      <div class="card-body pt-3">
                          <!-- Bordered Tabs -->
                          <ul class="nav nav-tabs nav-tabs-bordered">

                              <li class="nav-item">
                                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                      Profile</button>
                              </li>

                              <li class="nav-item">
                                  <button class="nav-link" data-bs-toggle="tab"
                                      data-bs-target="#profile-change-password">Ganti Password</button>
                              </li>

                          </ul>
                          <div class="tab-content pt-2">

                              <div class="tab-pane  fade show active profile-edit pt-3" id="profile-edit">

                                  <!-- Profile Edit Form -->
                                  <form id="form_edit_profile">
                                      <div class="row mb-3">
                                          <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="username" type="text" class="form-control" id="input-username"
                                                  value="{{ $userLogin->username }}">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-username"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="email" type="text" class="form-control" id="input-email"
                                                  value="{{ $userLogin->email }}">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-email"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="text-right">
                                          <button type="submit" class="btn btn-success">Update profile</button>
                                      </div>
                                  </form><!-- End Profile Edit Form -->

                              </div>

                              <div class="tab-pane fade pt-3" id="profile-change-password">
                                  <!-- Change Password Form -->
                                  <form id="form_change_password">

                                      <div class="row mb-3">
                                          <label for="password_sekarang" class="col-md-4 col-lg-3 col-form-label">
                                              Password sekarang
                                          </label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="password_sekarang" type="password" class="form-control"
                                                  id="input-password_sekarang">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-password_sekarang"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="password_baru" class="col-md-4 col-lg-3 col-form-label">
                                              Password baru
                                          </label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="password_baru" type="password" class="form-control"
                                                  id="input-password_baru">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-password_baru"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="row mb-3">
                                          <label for="ulang_password_baru" class="col-md-4 col-lg-3 col-form-label">
                                              Ulang password baru</label>
                                          <div class="col-md-8 col-lg-9">
                                              <input name="ulang_password_baru" type="password" class="form-control"
                                                  id="input-ulang_password_baru">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-ulang_password_baru"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="text-right">
                                          <button type="submit" class="btn btn-success">Update password</button>
                                      </div>
                                  </form><!-- End Change Password Form -->

                              </div>

                          </div><!-- End Bordered Tabs -->

                      </div>
                  </div>


              </div>
          </div>
      </section>

      <script>
          $(document).ready(function() {

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
          });


          $("#form_edit_profile").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = '{{ $userLogin->id }}';
              data_input.username = $("#input-username").val();
              data_input.email = $("#input-email").val();

              //reset validation
              for (obj in data_input) {
                  $(`#message-${obj}`).html('');
              }

              $.ajax({
                  url: '{{ route('profile.update') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {

                      $('#input-username').val(`${ response.data.username}`);
                      $('#input-email').val(`${ response.data.email}`);

                      //sweet alert message success
                      Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: `Success`,
                          text: `${response.message}`,
                          showConfirmButton: false,
                          timer: 2000
                      })
                  },
                  error: function(xhr, status, error) {
                      var err = eval(xhr.responseJSON);
                      console.log(err.errors);

                      if (err.errors != undefined) {

                          //error validation
                          for (var obj in err.errors) {
                              checkValidation(err.errors[obj], "input-" + obj, "message-" + obj);
                          }

                      } else {
                          //sweet alert message error
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: `${status}`,
                              text: `${err.message}`,
                              showConfirmButton: true
                          })
                      }
                  }
              })
          });

          $("#form_change_password").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = '{{ $userLogin->id }}';
              data_input.password_sekarang = $("#input-password_sekarang").val();
              data_input.password_baru = $("#input-password_baru").val();
              data_input.ulang_password_baru = $("#input-ulang_password_baru").val();

              //reset validation
              for (obj in data_input) {
                  $(`#message-${obj}`).html('');
              }

              $.ajax({
                  url: '{{ route('profile.update.password') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {

                      //reset form
                      $('#form_change_password').trigger("reset");

                      //reset validation
                      for (obj in data_input) {
                          $(`#message-${obj}`).html('');
                      }
                      //sweet alert message success
                      Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: `Success`,
                          text: `${response.message}`,
                          showConfirmButton: false,
                          timer: 2000
                      })
                  },
                  error: function(xhr, status, error) {
                      var err = eval(xhr.responseJSON);
                      console.log(err.errors);

                      if (err.errors != undefined) {

                          //error validation
                          for (var obj in err.errors) {
                              checkValidation(err.errors[obj], "input-" + obj, "message-" + obj);
                          }

                      } else {
                          //sweet alert message error
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: `${status}`,
                              text: `${err.message}`,
                              showConfirmButton: true
                          })
                      }
                  }
              })
          });



          function checkValidation(errorMsg, elementById, elementMsg) {
              document.getElementById(`${elementById}`).className = "form-control";
              $(`#${elementMsg}`).html(` ${errorMsg}`);
          }
      </script>
  @endsection
