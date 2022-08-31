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
                                      <select id="select-warga" class="form-control custom-select">
                                          <option value="-">-</option>
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
              $('#table-anggota').hide()

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              //select warga

              $('#select-kepala_keluarga').select2({
                  theme: "bootstrap"
              });

              $('#select-warga').select2({
                  theme: "bootstrap"
              });

              addAnggota = (sebagai) => {
                  var id_warga = $("#select-warga").val();
                  if (id_warga == "-") {

                  } else {

                      var status = (sebagai == 'kepala') ? 'Kepala Keluarga' : 'Anggota Keluarga';


                      console.log(id_warga)
                      var url = '{{ route('warga.show', ':id') }}';

                      $('#table-anggota').show()

                      $.ajax({
                          url: url.replace(':id', id_warga),
                          success: function(response) {
                              console.log(response);

                              var tr = $('#table-anggota tr[data-id="' + response.id + '"]');

                              console.log(tr.length);
                              if (!tr.length) {
                                  var markup =
                                      `
                                <tr data-id="${response.id}">
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

                  var col3 = currentRow.find("td:eq(2)").text(); // get current row 3rd TD

                  if (col3 == 'Kepala Keluarga') {
                      $("#button-kepala").show();
                  }
                  console.log(col3);
                  $(this).closest('tr').remove();
                  return false;
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
