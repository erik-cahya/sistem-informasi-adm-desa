  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Menu</li>
                  <li class="breadcrumb-item">Buat Surat</li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title text-uppercase">Input data {{ $title }}</h5>

                          <form id="form_create_surat">
                              @csrf

                              <div class="modal-body">

                                  <div class="row mb-3">
                                      <label for="input-no_surat" class="col-sm-2 col-form-label">Nomor Surat</label>
                                      <div class="col-sm-10">
                                          <input id="input-no_surat" type="text" class="form-control form-control-sm"
                                              value="" name="no_surat">
                                          <div class="invalid-feedback">
                                              <span id="message-no_surat"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <p><b>Yang bertanda tangan dibawah ini:</b></p>

                                  <div class="row mb-3">
                                      <label for="input-pembuat_nama" class="col-sm-2 col-form-label">Nama</label>
                                      <div class="col-sm-10">
                                          <input id="input-pembuat_nama" type="text" class="form-control form-control-sm"
                                              value="" name="pembuat_nama">
                                          <div class="invalid-feedback">
                                              <span id="message-pembuat_nama"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="input-pembuat_jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                      <div class="col-sm-10">
                                          <input id="input-pembuat_jabatan" type="text"
                                              class="form-control form-control-sm" value="" name="pembuat_jabatan">
                                          <div class="invalid-feedback">
                                              <span id="message-pembuat_jabatan"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="input-pembuat_alamat" class="col-sm-2 col-form-label">Alamat</label>
                                      <div class="col-sm-10">
                                          <input id="input-pembuat_alamat" type="text"
                                              class="form-control form-control-sm" value="" name="pembuat_alamat">
                                          <div class="invalid-feedback">
                                              <span id="message-pembuat_alamat"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <p><b>Dengan ini menerangkan dengan benar :</b></p>

                                  <div class="row mb-3">
                                      <label for="input-id" class="col-sm-2 col-form-label">Cari Nama/Ktp</label>
                                      <div class="col-sm-10">
                                          <select id="input-id"
                                              class="js-example-placeholder-single js-states form-control"
                                              style=" display:block; width:100%;">
                                              <option value="" disabled selected>Cari data KTP/Nama Lengkap</option>
                                              @foreach ($wargas as $warga)
                                                  <option value="{{ $warga->id }}">
                                                      {{ $warga->nama_lengkap }} ({{ $warga->no_ktp }})
                                                  </option>
                                              @endforeach
                                          </select>
                                          <div class="invalid-feedback">
                                              <span id="message-id"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-no_ktp" class="col-sm-2 col-form-label">NIK</label>
                                      <div class="col-sm-10">
                                          <input id="input-no_ktp" type="text" class="form-control form-control-sm"
                                              value="" name="no_ktp">
                                          <div class="invalid-feedback">
                                              <span id="message-no_ktp"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-nama_lengkap" class="col-sm-2 col-form-label">Nama</label>
                                      <div class="col-sm-10">
                                          <input id="input-nama_lengkap" type="text" class="form-control form-control-sm"
                                              value="" name="nama_lengkap">
                                          <div class="invalid-feedback">
                                              <span id="message-nama_lengkap"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-warga_negara"
                                          class="col-sm-2 col-form-label">Kewarganegaraan</label>
                                      <div class="col-sm-10">
                                          <input id="input-warga_negara" type="text" class="form-control form-control-sm"
                                              value="Indonesia" name="warga_negara">
                                          <div class="invalid-feedback">
                                              <span id="message-warga_negara"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                      <div class="col-sm-10">
                                          <input id="input-tempat_lahir" type="text"
                                              class="form-control form-control-sm" value="" name="tempat_lahir">
                                          <div class="invalid-feedback">
                                              <span id="message-tempat_lahir"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                      <div class="col-sm-10">
                                          <input id="input-tgl_lahir" type="date" class="form-control form-control-sm"
                                              value="" name="tgl_lahir">
                                          <div class="invalid-feedback">
                                              <span id="message-tgl_lahir"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-jenis_kelamin" class="col-sm-2 col-form-label">Jenis
                                          Kelamin</label>
                                      <div class="col-sm-10">
                                          <select id="input-jenis_kelamin" class="form-control custom-select"
                                              name="jenis_kelamin">
                                              <option value="" disabled selected></option>
                                              <option value="Laki-laki">Laki-laki</option>
                                              <option value="Perempuan">Perempuan</option>
                                          </select>
                                          <div class="invalid-feedback">
                                              <span id="message-jenis_kelamin"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-agama" class="col-sm-2 col-form-label">Agama</label>
                                      <div class="col-sm-10">
                                          <select id="input-agama" class="form-control custom-select" name="agama">
                                              <option value="" disabled selected></option>
                                              <option value="Islam">Islam</option>
                                              <option value="Protestan">Protestan</option>
                                              <option value="Katolik">Katolik</option>
                                              <option value="Hindu">Hindu</option>
                                              <option value="Buddha">Buddha</option>
                                              <option value="Khonghucu">Khonghucu</option>
                                              <option value="Penghayat Kepercayaan">Penghayat Kepercayaan</option>
                                          </select>
                                          <div class="invalid-feedback">
                                              <span id="message-agama"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-alamat_lengkap" class="col-sm-2 col-form-label">Alamat</label>
                                      <div class="col-sm-10">
                                          <input id="input-alamat_lengkap" type="text"
                                              class="form-control form-control-sm" value="" name="alamat_lengkap">
                                          <div class="invalid-feedback">
                                              <span id="message-alamat_lengkap"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <p><b>Dikeluarkan pada:</b></p>

                                  <div class="row mb-3">
                                      <label for="input-tempat_surat" class="col-sm-2 col-form-label">Tempat</label>
                                      <div class="col-sm-10">
                                          <input id="input-tempat_surat" type="text"
                                              class="form-control form-control-sm" value="{{ $params['nama_desa'] }}"
                                              name="tempat_surat">
                                          <div class="invalid-feedback">
                                              <span id="message-tempat_surat"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tgl_surat" class="col-sm-2 col-form-label">Tanggal</label>
                                      <div class="col-sm-10">
                                          <input id="input-tgl_surat" type="date" class="form-control form-control-sm"
                                              value="" name="tgl_surat">
                                          <div class="invalid-feedback">
                                              <span id="message-tgl_surat"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-kepala_desa" class="col-sm-2 col-form-label">Kepala Desa</label>
                                      <div class="col-sm-10">
                                          <input id="input-kepala_desa" type="text"
                                              class="form-control form-control-sm" value="{{ $params['kepala_desa'] }}"
                                              name="kepala_desa">
                                          <div class="invalid-feedback">
                                              <span id="message-kepala_desa"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                      onclick="window.location.reload();">Reset</button>
                                  <button type="submit" class="btn btn-success">Buat
                                      Surat</button>
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

              //get date now
              var today = new Date();
              var dd = ("0" + (today.getDate())).slice(-2);
              var mm = ("0" + (today.getMonth() + 1)).slice(-2);
              var yyyy = today.getFullYear();
              today = yyyy + '-' + mm + '-' + dd;
              $("#input-tgl_surat").attr("value", today);


              $('#input-id').select2({
                  theme: "bootstrap",
              });

              $('#input-id').on('change', function() {
                  var id = this.value;

                  var url = "{{ route('warga.show', ':id') }}";

                  $.ajax({
                      url: url.replace(':id', id),
                      success: function(response) {

                          $('#warga_id').val(`${response.id}`);

                          //set alamat
                          var alamat_lengkap = response.alamat + ', Dusun. ' + response.dusun;
                          $('#input-alamat_lengkap').val(`${alamat_lengkap}`);

                          //set value
                          for (key in response) {
                              $('#input-' + key).val(`${response[key]}`);
                          }


                          $('#data-warga').show();
                      },
                      error: function(xhr, status, error) {
                          console.log(error);

                          //sweet alert message error
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: `${status}`,
                              text: `${error}`,
                              showConfirmButton: true
                          });
                      }
                  })
              });

              //Create Data
              $("#form_create_surat").submit(function(event) {

                  /* stop form from submitting normally */
                  event.preventDefault();

                  var data_input = new Object();
                  data_input.warga_id = $("#input-id").val();

                  data_input.no_surat = $("#input-no_surat").val();
                  data_input.pembuat_nama = $("#input-pembuat_nama").val();
                  data_input.pembuat_jabatan = $("#input-pembuat_jabatan").val();
                  data_input.pembuat_alamat = $("#input-pembuat_alamat").val();

                  data_input.no_ktp = $("#input-no_ktp").val();
                  data_input.nama_lengkap = $("#input-nama_lengkap").val();
                  data_input.tempat_lahir = $("#input-tempat_lahir").val();
                  data_input.tgl_lahir = $("#input-tgl_lahir").val();
                  data_input.jenis_kelamin = $("#input-jenis_kelamin").val();
                  data_input.agama = $("#input-agama").val();
                  data_input.warga_negara = $("#input-warga_negara").val();
                  data_input.alamat_lengkap = $("#input-alamat_lengkap").val();

                  data_input.tempat_surat = $("#input-tempat_surat").val();
                  data_input.tgl_surat = $("#input-tgl_surat").val();
                  data_input.kepala_desa = $("#input-kepala_desa").val();

                  $.ajax({
                      url: "{{ route('surat.keterangan_ekonomi_lemah.create') }}",
                      method: 'POST',
                      dataType: 'json',
                      contentType: 'application/x-www-form-urlencoded',
                      data: data_input,
                      success: function(response) {

                          //sweet alert message success
                          Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: `Success`,
                              text: `${response.message}`,
                              showConfirmButton: false,
                              timer: 2000
                          }).then(function() {
                              var url = "{{ route('surat.download', ':fileName') }}";
                              window.location.replace(url.replace(':fileName', response
                                  .fileName));
                              document.getElementById("form_create_surat").reset();
                          });

                      },
                      error: function(xhr, status, error) {

                          //sweet alert message error
                          if (xhr.status == 422) {
                              Swal.fire({
                                  position: 'center',
                                  icon: 'warning',
                                  title: `Uppss...`,
                                  text: `${xhr.responseJSON.message}`,
                                  showConfirmButton: true
                              })
                          } else {
                              console.log(xhr);
                              Swal.fire({
                                  position: 'center',
                                  icon: 'error',
                                  title: `${xhr.status}`,
                                  text: `${error}`,
                                  showConfirmButton: true
                              })
                          }
                      }
                  })
              });
          });
      </script>
  @endsection
