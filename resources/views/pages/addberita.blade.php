  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Mutasi</li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">Input data</h5>


                          <form method="post" action="/berita/create/"
                                enctype="multipart/form-data">
                              @csrf
                                <div class="modal-body row">

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="input-nama_lengkap">Judul</label>
                                            <input id="judul" name="judul" type="text" class="form-control" value="" required>

                                            <div class="text-danger font-italic text-capital">
                                                <small id="message-nama_lengkap"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="input-nama_lengkap">Penulis</label>
                                            <input id="creator" name="creator" type="text" class="form-control" value="{{ Auth::user()->username }}" placeholder="Isi Penulis Berita"
                                            readonly>

                                            <div class="text-danger font-italic text-capital">
                                                <small id="message-nama_lengkap"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="input-nama_lengkap">Foto</label>
                                            <input id="thumbnail" name="thumbnail" type="file" class="form-control"
                                            required>

                                            <div class="text-danger font-italic text-capital">
                                                <small id="message-nama_lengkap"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="input-jenis_mutasi">Kategori</label>
                                            <select id="kategori" name="kategori" class="form-control custom-select" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($kategori as $kat)
                                                    <option value="{{ $kat->id }}">
                                                        {{ $kat->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger font-italic text-capital">
                                                <small id="message-jenis_mutasi"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="input-nama_lengkap">Isi Berita</label>
                                            <textarea id="berita" name="berita" class="form-control" required></textarea>

                                            <div class="text-danger font-italic text-capital">
                                                <small id="message-nama_lengkap"></small>
                                            </div>
                                        </div>
                                    </div>

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                      onclick="window.location.reload();">Reset</button>
                                  <button type="submit" class="btn btn-success">Simpan</button>
                              </div>
                          </form>
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

              $('#input-jenis_mutasi').on('change', function() {
                  var id = this.value;

                  if (id == 'Lahir') {
                      $('#form-input-no_ktp').hide();
                  } else {
                      $('#form-input-no_ktp').show();
                  }
              });

              //Create Data
              $("#form_mutasi_masuk").submit(function(event) {

                  /* stop form from submitting normally */
                  event.preventDefault();

                  var data_input = new Object();
                  data_input.create = "in";
                  data_input.no_ktp = $("#input-no_ktp").val();
                  data_input.nama_lengkap = $("#input-nama_lengkap").val();
                  data_input.agama = $("#input-agama").val();
                  data_input.tempat_lahir = $("#input-tempat_lahir").val();
                  data_input.tgl_lahir = $("#input-tgl_lahir").val();
                  data_input.jenis_kelamin = $("#input-jenis_kelamin").val();
                  data_input.alamat = $("#input-alamat").val();
                  data_input.dusun = $("#input-dusun").val();
                  data_input.rt = $("#input-rt").val();
                  data_input.rw = $("#input-rw").val();
                  data_input.baca_tulis = $("#input-baca_tulis").val();
                  data_input.golongan_darah = $("#input-golongan_darah").val();
                  data_input.warga_negara = $("#input-warga_negara").val();
                  data_input.pendidikan = $("#input-pendidikan").val();
                  data_input.pekerjaan = $("#input-pekerjaan").val();
                  data_input.status_nikah = $("#input-status_nikah").val();
                  data_input.jenis_mutasi = $("#input-jenis_mutasi").val();
                  data_input.tanggal_keluar_masuk = $("#input-tanggal_keluar_masuk").val();
                  data_input.keterangan = $("#input-keterangan").val();
                  //console.log(data_input);

                  //reset validation
                  for (obj in data_input) {
                      $(`#message-${obj}`).html('');
                  }

                  $.ajax({
                      url: "{{ route('mutasi.create') }}",
                      method: 'POST',
                      dataType: 'json',
                      contentType: 'application/x-www-form-urlencoded',
                      data: data_input,
                      success: function(response) {
                          // console.log(response);

                          $("#form_mutasi_masuk").trigger('reset');

                          //sweet alert message success
                          Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: `Success`,
                              text: `${response.message}`,
                              showConfirmButton: false,
                              timer: 2000
                          }).then(function() {
                              location.reload();
                          });

                      },
                      error: function(xhr, status, error) {
                          var err = eval(xhr.responseJSON);
                          console.log(err.errors);

                          if (err.errors != undefined) {

                              //error validation
                              for (var obj in err.errors) {
                                  checkValidation(err.errors[obj], "input-" + obj, "message-" +
                                      obj);
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
          });
      </script>
  @endsection
