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


                          <form id="form_mutasi_masuk">
                              @csrf
                              <div class="modal-body row">

                                  <div class="col-lg-6">
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label for="input-no_ktp">No KTP/ID</label>
                                              <input id="input-no_ktp" type="text" class="form-control" value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-no_ktp"></small>
                                              </div>
                                          </div>

                                          <div class="form-group col-md-6">
                                              <label for="input-warga_negara">Kewarganegaraan</label>
                                              <input id="input-warga_negara" type="text" class="form-control"
                                                  list="list-warga_negara" value="Indonesia">

                                              <datalist id="list-warga_negara">
                                                  <option>Indonesia</option>
                                              </datalist>

                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-warga_negara"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-nama_lengkap">Nama Lengkap</label>
                                          <input id="input-nama_lengkap" type="text" class="form-control" value="">

                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-nama_lengkap"></small>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-agama">Agama</label>
                                          <select id="input-agama" class="form-control custom-select">
                                              <option value="" selected disabled></option>
                                              <option value="Islam">Islam</option>
                                              <option value="Protestan">Protestan</option>
                                              <option value="Katolik">Katolik</option>
                                              <option value="Hindu">Hindu</option>
                                              <option value="Buddha">Buddha</option>
                                              <option value="Khonghucu">Khonghucu</option>
                                              <option value="Penghayat Kepercayaan">Penghayat Kepercayaan</option>
                                          </select>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-agama"></small>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label for="input-tempat_lahir">Tempat Lahir</label>
                                              <input id="input-tempat_lahir" type="text" class="form-control"
                                                  value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-tempat_lahir"></small>
                                              </div>
                                          </div>

                                          <div class="form-group col-md-6">
                                              <label for="input-tgl_lahir">Tanggal
                                                  Lahir<small class="text-small">(Tanggal/Bulan/Tahun)</small>
                                              </label>
                                              <input id="input-tgl_lahir" type="date" class="form-control"
                                                  value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-tgl_lahir"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-jenis_kelamin">Jenis Kelamin</label>
                                          <select id="input-jenis_kelamin" class="form-control custom-select">
                                              <option value="" selected disabled></option>
                                              <option value="Laki-laki">Laki-laki</option>
                                              <option value="Perempuan">Perempuan</option>
                                          </select>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-jenis_kelamin"></small>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-alamat">Alamat</label>
                                          <input id="input-alamat" type="text" class="form-control" value="">
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-alamat"></small>
                                          </div>
                                      </div>

                                      <div class="row">
                                          <div class="form-group col-md-4">
                                              <label for="input-dusun">Dusun</label>
                                              <input id="input-dusun" type="text" class="form-control" value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-dusun"></small>
                                              </div>
                                          </div>

                                          <div class="form-group col-md-4">
                                              <label for="input-rt">RT</label>
                                              <input id="input-rt" type="text" class="form-control" value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-rt"></small>
                                              </div>
                                          </div>

                                          <div class="form-group col-md-4">
                                              <label for="input-rw">RW</label>
                                              <input id="input-rw" type="text" class="form-control" value="">
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-rw"></small>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-golongan_darah">Golongan Darah</label>
                                          <select id="input-golongan_darah" class="form-control custom-select">
                                              <option value="-" selected>Tidak Diketahui</option>
                                              <option value="O">O</option>
                                              <option value="A">A</option>
                                              <option value="B">B</option>
                                              <option value="AB">AB</option>
                                          </select>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-golongan_darah"></small>
                                          </div>
                                      </div>


                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label for="input-pendidikan">Pendidikan</label>
                                              <select id="input-pendidikan" class="form-control custom-select">
                                                  <option value="" selected disabled></option>
                                                  <option value="TIDAK/BELUM SEKOLAH">
                                                      TIDAK/BELUM SEKOLAH
                                                  </option>
                                                  <option value="BELUM TAMAT SD/SEDERAJAT">
                                                      BELUM TAMAT SD/SEDERAJAT
                                                  </option>
                                                  <option value="TAMAT SD/SEDERAJAT">
                                                      TAMAT SD/SEDERAJAT
                                                  </option>
                                                  <option value="SLTP/SEDERAJAT">
                                                      SLTP/SEDERAJAT
                                                  </option>
                                                  <option value="SLTA/SEDERAJAT">
                                                      SLTA/SEDERAJAT
                                                  </option>
                                                  <option value="DIPLOMA I/II">
                                                      DIPLOMA I/II
                                                  </option>
                                                  <option value="AKADEMI/DIPLOMA III/S. MUDA">
                                                      AKADEMI/DIPLOMA III/S. MUDA
                                                  </option>
                                                  <option value="DIPLOMA IV/STRATA I">
                                                      DIPLOMA IV/STRATA I
                                                  </option>
                                                  <option value="STRATA II">
                                                      STRATA II
                                                  </option>
                                                  <option value="STRATA III">
                                                      STRATA III
                                                  </option>
                                              </select>
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-pendidikan"></small>
                                              </div>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="input-baca_tulis">Baca tulis?</label>
                                              <select id="input-baca_tulis" class="form-control custom-select">
                                                  <option value="" selected disabled></option>
                                                  <option value="iya"> Iya </option>
                                                  <option value="tidak"> Tidak </option>
                                              </select>
                                              <div class="text-danger font-italic text-capital">
                                                  <small id="message-baca_tulis"></small>
                                              </div>
                                          </div>

                                      </div>
                                      <div class="form-group">
                                          <label for="input-pekerjaan">Pekerjaan</label>
                                          <input id="input-pekerjaan" type="text" class="form-control"
                                              value="">
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-pekerjaan"></small>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="input-status_nikah">Status Perkawinan</label>
                                          <select id="input-status_nikah" class="form-control custom-select">
                                              <option value="" selected disabled></option>
                                              <option value="Belum Kawin">Belum Kawin</option>
                                              <option value="Kawin">Kawin</option>
                                              <option value="Cerai hidup">Cerai hidup</option>
                                              <option value="Cerai mati"> Cerai mati</option>
                                          </select>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-status_nikah"></small>
                                          </div>
                                      </div>

                                  </div>
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                          <label for="input-jenis_mutasi">Jenis Mutasi</label>
                                          <select id="input-jenis_mutasi"
                                              class="form-control form-control-sm custom-select">
                                              <option value="" disabled selected>Pilih Jenis mutasi</option>
                                              @foreach ($tipeMutasi as $mut)
                                                  <option value="{{ $mut }}">
                                                      {{ $mut }}
                                                  </option>
                                              @endforeach
                                          </select>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-jenis_mutasi"></small>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-tanggal_keluar_masuk">Tanggal mutasi</label>
                                          <input id="input-tanggal_keluar_masuk" type="date"
                                              class="form-control form-control-sm" value="">
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-tanggal_keluar_masuk"></small>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="input-keterangan">Keterangan</label>
                                          <textarea id="input-keterangan" class="form-control form-control-sm" style="height: 100px" value=""></textarea>
                                          <div class="text-danger font-italic text-capital">
                                              <small id="message-keterangan"></small>
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
                      url: '{{ route('mutasi.create') }}',
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
