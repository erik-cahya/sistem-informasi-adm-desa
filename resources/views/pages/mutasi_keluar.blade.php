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
              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">Input data</h5>


                          <form id="form_create_mutasi">
                              @csrf
                              <div class="modal-body">
                                  <input id="warga_id" type="hidden">
                                  <div class="form-group">
                                      <label for="input-ktp">No KTP/ID</label>
                                      <select id="input-ktp" class="js-example-placeholder-single js-states form-control"
                                          style=" display:block; width:100%;">
                                          <option value="" disabled selected>Cari data KTP/Nama Lengkap</option>
                                          @foreach ($wargas as $warga)
                                              <option value="{{ $warga->id }}">
                                                  {{ $warga->nama_lengkap }} ({{ $warga->no_ktp }})
                                              </option>
                                          @endforeach
                                      </select>
                                      <div class="text-danger font-italic text-capital">
                                          <small id="message-ktp"></small>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label for="input-jenis_mutasi">Jenis Mutasi</label>
                                      <select id="input-jenis_mutasi" class="form-control form-control-sm custom-select">
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
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                      onclick="window.location.reload();">Reset</button>
                                  <button type="submit" class="btn btn-success">Simpan</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
              <div id="data-warga" class="col-lg-6">
                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">Data Penduduk</h5>

                          <div class="modal-body">

                              <div class="form-group">
                                  <label for="input-nama_lengkap">Nama Lengkap</label>
                                  <input id="input-nama_lengkap" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>

                              <div class="form-group">
                                  <label for="input-agama">Agama</label>
                                  <input id="input-agama" type="text" class="form-control form-control-sm" value=""
                                      readonly>
                              </div>

                              <div class="row">
                                  <div class="form-group col-md-6">
                                      <label for="input-tempat_lahir">Tempat Lahir</label>
                                      <input id="input-tempat_lahir" type="text" class="form-control form-control-sm"
                                          value="" readonly>
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label for="input-tgl_lahir">Tanggal Lahir</label>
                                      <input id="input-tgl_lahir" type="date" class="form-control form-control-sm"
                                          value="" readonly>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="input-jenis_kelamin">Jenis Kelamin</label>
                                  <input id="input-jenis_kelamin" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>

                              <div class="form-group">
                                  <label for="input-pendidikan">Pendidikan</label>
                                  <input id="input-pendidikan" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>

                              <div class="form-group">
                                  <label for="input-pekerjaan">Pekerjaan</label>
                                  <input id="input-pekerjaan" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>

                              <div class="form-group">
                                  <label for="input-warga_negara">Kewarganegaraan</label>
                                  <input id="input-warga_negara" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>

                              <div class="form-group">
                                  <label for="input-status_nikah">Status Perkawinan</label>
                                  <input id="input-status_nikah" type="text" class="form-control form-control-sm"
                                      value="" readonly>
                              </div>


                          </div>

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

              $('#data-warga').hide();

              $('#input-ktp').select2({
                  theme: "bootstrap",
              });

              $('#input-ktp').on('change', function() {
                  var id = this.value;

                  console.log(id);
                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id),
                      success: function(response) {
                          //console.log(response);

                          $('#warga_id').val(`${response.id}`);

                          //set value
                          for (key in response) {
                              $('#input-' + key).val(`${response[key]}`);
                          }


                          $('#data-warga').show();
                      },
                      error: function(xhr, status, error) {
                          console.log(error);
                          //close modal
                          $('#moda .close').click();

                          //sweet alert message error
                          Swal.fire({
                              position: 'center',
                              icon: 'error',
                              title: `${status}`,
                              text: `${error}`,
                              showConfirmButton: true
                          });

                          $('#data-warga').hide();
                      }
                  })
              });

              //Create Data
              $("#form_create_mutasi").submit(function(event) {

                  /* stop form from submitting normally */
                  event.preventDefault();

                  var data_input = new Object();
                  data_input.create = "out";
                  data_input.ktp = $("#input-ktp").val();
                  data_input.jenis_mutasi = $("#input-jenis_mutasi").val();
                  data_input.tanggal_keluar_masuk = $("#input-tanggal_keluar_masuk").val();
                  data_input.keterangan = $("#input-keterangan").val();

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
                          console.log(response);


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
                  $(`#${elementMsg}`).html(` ${errorMsg}`);
              }
          });
      </script>
  @endsection
