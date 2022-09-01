  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Master</li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">

                  <div class="card ">
                      <div class="card-body">

                          <h5 class="card-title">{{ $title }}</h5>


                          <form id="form_new_keluarga" method="post">
                              @csrf
                              <div class="form-group">
                                  <label for="input-no_kk">Nomor Kartu Keluarga</label>
                                  <input id="input-no_kk" type="text" class="form-control form-control-sm"
                                      value="">

                                  <div class="invalid-feedback">
                                      <span id="message-no_kk"></span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="input-alamat">Alamat</label>
                                  <input id="input-alamat" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="invalid-feedback">
                                      <span id="message-alamat"></span>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="form-group col-md-4">
                                      <label for="input-dusun">Dusun</label>
                                      <input id="input-dusun" type="text" class="form-control form-control-sm"
                                          value="">
                                      <div class="invalid-feedback">
                                          <span id="message-dusun"></span>
                                      </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                      <label for="input-rt">RT</label>
                                      <input id="input-rt" type="text" class="form-control form-control-sm"
                                          value="">
                                      <div class="invalid-feedback">
                                          <span id="message-rt"></span>
                                      </div>
                                  </div>

                                  <div class="form-group col-md-4">
                                      <label for="input-rw">RW</label>
                                      <input id="input-rw" type="text" class="form-control form-control-sm"
                                          value="">
                                      <div class="invalid-feedback">
                                          <span id="message-rw"></span>
                                      </div>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label for="input-ekonomi">Status Ekonomi</label>
                                  <select id="input-ekonomi" class="form-control form-control-sm custom-select">
                                      <option value="A">A</option>
                                      <option value="B">B</option>
                                      <option value="C">C</option>
                                  </select>
                              </div>

                              <div class="form-group">
                                  <label for="table-anggota">Daftar Anggota</label>

                                  <div class="d-flex flex-row">
                                      <select id="input-anggota"
                                          class="js-example-placeholder-single js-states form-control custom-select">
                                          <option value="-"></option>
                                          @foreach ($wargas as $warga)
                                              <option value="{{ $warga->id }}">{{ $warga->nama_lengkap }}
                                                  ({{ $warga->no_ktp }})
                                              </option>
                                          @endforeach
                                      </select>
                                      <button class="btn btn-sm ml-2 btn-success dropdown-toggle" type="button"
                                          data-bs-toggle="dropdown" aria-expanded="false">Tambahkan sebagai</button>
                                      <ul class="dropdown-menu dropdown-menu-end">
                                          <li>
                                              <a id="button-kepala" class="dropdown-item"
                                                  onclick="addAnggota('kepala')">Kepala
                                                  Keluarga</a>
                                          </li>
                                          <li>
                                              <a id="button-anggota" class="dropdown-item"
                                                  onclick="addAnggota('anggota')">Anggota
                                                  Keluarga</a>
                                          </li>
                                      </ul>

                                  </div>

                                  <table id="table-anggota" class="table">
                                      <tr>
                                          <th style="display: none">ID</th>
                                          <th>NIK</th>
                                          <th>Nama Lengkap</th>
                                          <th>Status</th>
                                          <th width="10%" style="text-align: right">Aksi</th>
                                      </tr>
                                  </table>
                              </div>

                              <button type="submit" class="btn btn-info mb-4 float-right">Simpan Data</button>


                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <script>
          $(document).ready(function() {
              $('#table-anggota').hide();

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              //select warga
              $('#input-anggota').select2({
                  theme: "bootstrap",
              });

              addAnggota = (sebagai) => {
                  var id_warga = $("#input-anggota").val();
                  if (id_warga == "-" || id_warga == undefined) {

                  } else {

                      var status = (sebagai == 'kepala') ? 'Kepala Keluarga' : 'Anggota Keluarga';

                      var url = '{{ route('warga.show', ':id') }}';

                      $.ajax({
                          url: url.replace(':id', id_warga),
                          success: function(response) {

                              var tr = $('#table-anggota tr[data-id="' + response.id + '"]');


                              if (!tr.length) {
                                  var markup =
                                      `
                                <tr data-id="${response.id}">
                                    <td style="display:none;">${response.id}</td>
                                    <td>${ response.no_ktp}</td>
                                    <td>${ response.nama_lengkap}</td>
                                    <td>${ status}</td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="btndeleterowadded btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                              `;
                                  $("#table-anggota tbody").append(markup);
                                  $('#table-anggota').show();

                                  if (sebagai == 'kepala') {
                                      $("#button-kepala").hide();
                                  };

                              } else {
                                  Swal.fire({
                                      position: 'center',
                                      icon: 'warning',
                                      title: `Upss...`,
                                      text: `Data ${response.nama_lengkap} sudah ditambahkan`,
                                      showConfirmButton: true
                                  })
                              }
                              $("#input-anggota").val('').trigger('change')
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
                      });
                  }

              }

              //delete anggota
              $(document).on('click', 'button.btndeleterowadded', function() {
                  // get the current row
                  var currentRow = $(this).closest("tr");

                  // get current row 3rd TD
                  var col3 = currentRow.find("td:eq(3)").text();
                  if (col3 == 'Kepala Keluarga') {
                      $("#button-kepala").show();
                  }

                  //hide table if no data
                  var rowCount = $("#table-anggota tr").length;
                  if (rowCount == 2) {
                      $('#table-anggota').hide();
                  }


                  $(this).closest('tr').remove();
                  return false;
              });

              //Create Data
              $("#form_new_keluarga").submit(function(event) {

                  /* stop form from submitting normally */
                  event.preventDefault();



                  //get data  from table
                  var DataAnggota = [];
                  var checkKepalaKeluarga = false;
                  $('#table-anggota tr').each(function(index) {

                      //get Id Anggota
                      var id = $(this).find("td:eq(0)").html();

                      //get Status Anggota
                      var status = $(this).find("td:eq(3)").html();

                      if (status == "Kepala Keluarga") {
                          checkKepalaKeluarga = true;
                      }

                      var anggota = new Object();
                      anggota.id = id;
                      anggota.status = status;

                      if (index != 0) {
                          DataAnggota[index - 1] = anggota;
                      }
                  });

                  //cek kepala keluarga
                  if (!checkKepalaKeluarga) {
                      Swal.fire({
                          position: 'center',
                          icon: 'warning',
                          title: `Upss...`,
                          text: `Masukkan anggota Kepala keluarga`,
                          showConfirmButton: true
                      })
                      checkKepalaKeluarga = false;
                  } else {

                      var data_input = new Object();
                      data_input.no_kk = $("#input-no_kk").val();
                      data_input.alamat = $("#input-alamat").val();
                      data_input.dusun = $("#input-dusun").val();
                      data_input.rt = $("#input-rt").val();
                      data_input.rw = $("#input-rw").val();
                      data_input.ekonomi = $("#input-ekonomi").val();
                      data_input.anggotas = DataAnggota;

                      console.log(data_input);


                      //reset validation
                      for (obj in data_input) {
                          $(`#input-${obj}`).attr("class", "form-control is-valid");
                      }

                      $.ajax({
                          url: '{{ route('keluarga.create') }}',
                          method: 'POST',
                          dataType: 'json',
                          contentType: 'application/x-www-form-urlencoded',
                          data: data_input,
                          success: function(response) {
                              console.log(response);

                              $("#form_new_keluarga").trigger('reset');
                              $("#table-anggota tr").remove();
                              $('#table-anggota').hide();

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
                                      checkValidation(err.errors[obj], "input-" + obj,
                                          "message-" +
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
                  }
              });


              function checkValidation(errorMsg, elementById, elementMsg) {
                  if (errorMsg != undefined) {
                      document.getElementById(`${elementById}`).className = "form-control is-invalid";
                      $(`#${elementMsg}`).html(` ${errorMsg}`);
                  } else {
                      document.getElementById(`${elementById}`).className = "form-control is-valid";
                  }
              }
          });
      </script>
  @endsection
