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

                                  <p><b>Dengan ini menerangkan dengan benar:</b></p>

                                  <div class="row mb-3">
                                      <label for="input-nama_lengkap_anak" class="col-sm-2 col-form-label">Nama anak</label>
                                      <div class="col-sm-10">
                                          <input id="input-nama_lengkap_anak" type="text"
                                              class="form-control form-control-sm" value="" name="nama_lengkap_anak">
                                          <div class="invalid-feedback">
                                              <span id="message-nama_lengkap_anak"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row mb-3">
                                      <label for="input-pekerjaan_anak" class="col-sm-2 col-form-label">Pekerjaan
                                          anak</label>
                                      <div class="col-sm-10">
                                          <input id="input-pekerjaan_anak" type="text"
                                              class="form-control form-control-sm" value="" name="pekerjaan_anak">
                                          <div class="invalid-feedback">
                                              <span id="message-pekerjaan_anak"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <hr>

                                  <div class="row mb-3">
                                      <label for="input-id" class="col-sm-2 col-form-label">Cari Nama/Ktp ayah</label>
                                      <div class="col-sm-10">
                                          <select id="input-id_ayah"
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
                                      <label for="input-no_ktp_ayah" class="col-sm-2 col-form-label">NIK Ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-no_ktp_ayah" type="text" class="form-control form-control-sm"
                                              value="" name="no_ktp_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-no_ktp_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-nama_lengkap_ayah" class="col-sm-2 col-form-label">Nama
                                          ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-nama_lengkap_ayah" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="nama_lengkap_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-nama_lengkap_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tempat_lahir_ayah" class="col-sm-2 col-form-label">Tempat
                                          lahir ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-tempat_lahir_ayah" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="tempat_lahir_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-tempat_lahir_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tgl_lahir_ayah" class="col-sm-2 col-form-label">Tanggal
                                          lahir ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-tgl_lahir_ayah" type="date"
                                              class="form-control form-control-sm" value="" name="tgl_lahir_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-tgl_lahir_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-jenis_kelamin_ayah" class="col-sm-2 col-form-label">Jenis
                                          Kelamin ayah</label>
                                      <div class="col-sm-10">
                                          <select id="input-jenis_kelamin_ayah" class="form-control custom-select"
                                              name="jenis_kelamin_ayah">
                                              <option value="" disabled selected></option>
                                              <option value="Laki-laki">Laki-laki</option>
                                              <option value="Perempuan">Perempuan</option>
                                          </select>
                                          <div class="invalid-feedback">
                                              <span id="message-jenis_kelamin_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-agama_ayah" class="col-sm-2 col-form-label">Agama ayah</label>
                                      <div class="col-sm-10">
                                          <select id="input-agama_ayah" class="form-control custom-select"
                                              name="agama_ayah">
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
                                              <span id="message-agama_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-pekerjaan_ayah" class="col-sm-2 col-form-label">Pekerjaan
                                          ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-pekerjaan_ayah" type="text"
                                              class="form-control form-control-sm" value="" name="pekerjaan_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-pekerjaan_ayah"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-alamat_lengkap_ayah" class="col-sm-2 col-form-label">Alamat
                                          ayah</label>
                                      <div class="col-sm-10">
                                          <input id="input-alamat_lengkap_ayah" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="alamat_lengkap_ayah">
                                          <div class="invalid-feedback">
                                              <span id="message-alamat_lengkap_ayah"></span>
                                          </div>
                                      </div>
                                  </div>

                                  <hr>

                                  <div class="row mb-3">
                                      <label for="input-id" class="col-sm-2 col-form-label">Cari Nama/Ktp ibu</label>
                                      <div class="col-sm-10">
                                          <select id="input-id_ibu"
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
                                      <label for="input-no_ktp_ibu" class="col-sm-2 col-form-label">NIK Ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-no_ktp_ibu" type="text"
                                              class="form-control form-control-sm" value="" name="no_ktp_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-no_ktp_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-nama_lengkap_ibu" class="col-sm-2 col-form-label">Nama
                                          ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-nama_lengkap_ibu" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="nama_lengkap_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-nama_lengkap_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tempat_lahir_ibu" class="col-sm-2 col-form-label">Tempat
                                          lahir ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-tempat_lahir_ibu" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="tempat_lahir_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-tempat_lahir_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-tgl_lahir_ibu" class="col-sm-2 col-form-label">Tanggal
                                          lahir ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-tgl_lahir_ibu" type="date"
                                              class="form-control form-control-sm" value="" name="tgl_lahir_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-tgl_lahir_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-jenis_kelamin_ibu" class="col-sm-2 col-form-label">Jenis
                                          Kelamin ibu</label>
                                      <div class="col-sm-10">
                                          <select id="input-jenis_kelamin_ibu" class="form-control custom-select"
                                              name="jenis_kelamin_ibu">
                                              <option value="" disabled selected></option>
                                              <option value="Laki-laki">Laki-laki</option>
                                              <option value="Perempuan">Perempuan</option>
                                          </select>
                                          <div class="invalid-feedback">
                                              <span id="message-jenis_kelamin_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-agama_ibu" class="col-sm-2 col-form-label">Agama ibu</label>
                                      <div class="col-sm-10">
                                          <select id="input-agama_ibu" class="form-control custom-select"
                                              name="agama_ibu">
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
                                              <span id="message-agama_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-pekerjaan_ibu" class="col-sm-2 col-form-label">Pekerjaan
                                          ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-pekerjaan_ibu" type="text"
                                              class="form-control form-control-sm" value="" name="pekerjaan_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-pekerjaan_ibu"></span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <label for="input-alamat_lengkap_ibu" class="col-sm-2 col-form-label">Alamat
                                          ibu</label>
                                      <div class="col-sm-10">
                                          <input id="input-alamat_lengkap_ibu" type="text"
                                              class="form-control form-control-sm" value=""
                                              name="alamat_lengkap_ibu">
                                          <div class="invalid-feedback">
                                              <span id="message-alamat_lengkap_ayah"></span>
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


              $('#input-id_ayah').select2({
                  theme: "bootstrap",
              });

              $('#input-id_ayah').on('change', function() {
                  var id = this.value;

                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id),
                      success: function(response) {

                          //set alamat
                          var alamat_lengkap = response.alamat + ', Dusun. ' + response.dusun;
                          $('#input-alamat_lengkap_ayah').val(`${alamat_lengkap}`);

                          //set value
                          for (key in response) {
                              $('#input-' + key + '_ayah').val(`${response[key]}`);
                          }

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

              $('#input-id_ibu').select2({
                  theme: "bootstrap",
              });

              $('#input-id_ibu').on('change', function() {
                  var id = this.value;

                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id),
                      success: function(response) {

                          //set alamat
                          var alamat_lengkap = response.alamat + ', Dusun. ' + response.dusun;
                          $('#input-alamat_lengkap_ibu').val(`${alamat_lengkap}`);

                          //set value
                          for (key in response) {
                              $('#input-' + key + '_ibu').val(`${response[key]}`);
                          }

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
                  data_input.no_surat = $("#input-no_surat").val();
                  data_input.pembuat_nama = $("#input-pembuat_nama").val();
                  data_input.pembuat_jabatan = $("#input-pembuat_jabatan").val();
                  data_input.pembuat_alamat = $("#input-pembuat_alamat").val();

                  data_input.no_ktp_ayah = $("#input-no_ktp_ayah").val();
                  data_input.nama_lengkap_ayah = $("#input-nama_lengkap_ayah").val();
                  data_input.tempat_lahir_ayah = $("#input-tempat_lahir_ayah").val();
                  data_input.tgl_lahir_ayah = $("#input-tgl_lahir_ayah").val();
                  data_input.jenis_kelamin_ayah = $("#input-jenis_kelamin_ayah").val();
                  data_input.agama_ayah = $("#input-agama_ayah").val();
                  data_input.pekerjaan_ayah = $("#input-pekerjaan_ayah").val();
                  data_input.alamat_lengkap_ayah = $("#input-alamat_lengkap_ayah").val();

                  data_input.no_ktp_ibu = $("#input-no_ktp_ibu").val();
                  data_input.nama_lengkap_ibu = $("#input-nama_lengkap_ibu").val();
                  data_input.tempat_lahir_ibu = $("#input-tempat_lahir_ibu").val();
                  data_input.tgl_lahir_ibu = $("#input-tgl_lahir_ibu").val();
                  data_input.jenis_kelamin_ibu = $("#input-jenis_kelamin_ibu").val();
                  data_input.agama_ibu = $("#input-agama_ibu").val();
                  data_input.pekerjaan_ibu = $("#input-pekerjaan_ibu").val();
                  data_input.alamat_lengkap_ibu = $("#input-alamat_lengkap_ibu").val();

                  data_input.nama_lengkap_anak = $("#input-nama_lengkap_anak").val();
                  data_input.pekerjaan_anak = $("#input-pekerjaan_anak").val();

                  data_input.tempat_surat = $("#input-tempat_surat").val();
                  data_input.tgl_surat = $("#input-tgl_surat").val();
                  data_input.kepala_desa = $("#input-kepala_desa").val();

                  $.ajax({
                      url: '{{ route('surat.keterangan_pekerjaan_orang_tua.create') }}',
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
                              var url = '{{ route('surat.download', ':fileName') }}';
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
