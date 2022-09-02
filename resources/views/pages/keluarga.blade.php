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
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">{{ $title }}</h5>

                          <button type="button" class="btn btn-success mb-4" data-toggle="modal"
                              data-target="#modalNewKeluarga" onclick="newModalKeluarga()"> <i
                                  class="bx bx-plus"></i>&nbsp;Buat Baru</button>

                          <div id="modalNewKeluarga" class="modal fade" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                      <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel">Tambah keluarga baru</h4>
                                          <button type="button" class="close" data-dismiss="modal">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <form id="form_new_keluarga" method="post">
                                          <div class="modal-body">
                                              @csrf
                                              <div class="form-group">
                                                  <label for="input-no_kk">Nomor Kartu Keluarga</label>
                                                  <input id="input-no_kk" type="text"
                                                      class="form-control form-control-sm" value="">

                                                  <div class="invalid-feedback">
                                                      <span id="message-no_kk"></span>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-alamat">Alamat</label>
                                                  <input id="input-alamat" type="text"
                                                      class="form-control form-control-sm" value="">
                                                  <div class="invalid-feedback">
                                                      <span id="message-alamat"></span>
                                                  </div>
                                              </div>

                                              <div class="row">
                                                  <div class="form-group col-md-4">
                                                      <label for="input-dusun">Dusun</label>
                                                      <input id="input-dusun" type="text"
                                                          class="form-control form-control-sm" value="">
                                                      <div class="invalid-feedback">
                                                          <span id="message-dusun"></span>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                      <label for="input-rt">RT</label>
                                                      <input id="input-rt" type="text"
                                                          class="form-control form-control-sm" value="">
                                                      <div class="invalid-feedback">
                                                          <span id="message-rt"></span>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                      <label for="input-rw">RW</label>
                                                      <input id="input-rw" type="text"
                                                          class="form-control form-control-sm" value="">
                                                      <div class="invalid-feedback">
                                                          <span id="message-rw"></span>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-ekonomi">Status Ekonomi</label>
                                                  <select id="input-ekonomi"
                                                      class="form-control form-control-sm custom-select">
                                                      <option value="A">A</option>
                                                      <option value="B">B</option>
                                                      <option value="C">C</option>
                                                  </select>
                                              </div>

                                              <div class="form-group">
                                                  <label for="table-anggota">Daftar Anggota</label>

                                                  <div class="d-flex flex-row">
                                                      <select id="input-anggota"
                                                          class="js-example-placeholder-single js-states form-control custom-select"
                                                          style=" display:block; width:100%;">
                                                          <option value="-"></option>
                                                          @foreach ($wargas as $warga)
                                                              <option value="{{ $warga->id }}">{{ $warga->nama_lengkap }}
                                                                  ({{ $warga->no_ktp }})
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                      <button class="btn btn-sm ml-2 btn-outline-success dropdown-toggle"
                                                          type="button" data-bs-toggle="dropdown"
                                                          aria-expanded="false">Tambahkan
                                                          sebagai</button>
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
                                                      <thead>
                                                          <tr>
                                                              <th style="display: none">ID</th>
                                                              <th>NIK</th>
                                                              <th>Nama Lengkap</th>
                                                              <th>Status</th>
                                                              <th width="10%" style="text-align: right">Aksi</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>

                                                      </tbody>
                                                  </table>
                                              </div>
                                          </div>

                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-dismiss="modal">Keluar</button>
                                              <button type="submit" class="btn btn-success">
                                                  Simpan Data
                                              </button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>

                          <div id="printbar" style="float:right"></div>
                          <div class="table-responsive">
                              <table id="tableKeluarga" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>No kk</th>
                                          <th>Kepala keluarga</th>
                                          <th>Jumlah anggota</th>
                                          <th>Alamat</th>
                                          <th>Dusun</th>
                                          <th>RT</th>
                                          <th>RW</th>
                                          <th>Ekonomi</th>
                                          <th style="text-align: right">Aksi</th>
                                      </tr>
                                  </thead>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- /page content -->
      <div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editLabel">Edit {{ $title }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="form_edit_keluarga" method="post">
                      <div class="modal-body">
                          @csrf
                          <input id="input-edit-id" type="hidden" />
                          <div class="form-group">
                              <label for="edit-edit-no_kk">Nomor Kartu Keluarga</label>
                              <input id="input-edit-no_kk" type="text" class="form-control form-control-sm"
                                  value="">

                              <div class="invalid-feedback">
                                  <span id="message-edit-no_kk"></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-alamat">Alamat</label>
                              <input id="input-edit-alamat" type="text" class="form-control form-control-sm"
                                  value="">
                              <div class="invalid-feedback">
                                  <span id="message-edit-alamat"></span>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-4">
                                  <label for="input-edit-dusun">Dusun</label>
                                  <input id="input-edit-dusun" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="invalid-feedback">
                                      <span id="message-edit-dusun"></span>
                                  </div>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="input-edit-rt">RT</label>
                                  <input id="input-edit-rt" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="invalid-feedback">
                                      <span id="message-edit-rt"></span>
                                  </div>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="input-edit-rw">RW</label>
                                  <input id="input-edit-rw" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="invalid-feedback">
                                      <span id="message-edit-rw"></span>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-ekonomi">Status Ekonomi</label>
                              <select id="input-edit-ekonomi" class="form-control form-control-sm custom-select">
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="C">C</option>
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="table-edit-anggota">Daftar Anggota</label>

                              <div class="d-flex flex-row">
                                  <select id="input-edit-anggota"
                                      class="js-example-placeholder-single js-states form-control custom-select"
                                      style=" display:block; width:100%;">
                                      <option value="-"></option>
                                      @foreach ($wargas as $warga)
                                          <option value="{{ $warga->id }}">{{ $warga->nama_lengkap }}
                                              ({{ $warga->no_ktp }})
                                          </option>
                                      @endforeach
                                  </select>
                                  <button class="btn btn-sm ml-2 btn-outline-success dropdown-toggle" type="button"
                                      data-bs-toggle="dropdown" aria-expanded="false">Tambahkan sebagai</button>
                                  <ul class="dropdown-menu dropdown-menu-end">
                                      <li>
                                          <a id="button-edit-kepala" class="dropdown-item"
                                              onclick="addAnggotaEdit('kepala')">Kepala
                                              Keluarga</a>
                                      </li>
                                      <li>
                                          <a id="button-edit-anggota" class="dropdown-item"
                                              onclick="addAnggotaEdit('anggota')">Anggota
                                              Keluarga</a>
                                      </li>
                                  </ul>

                              </div>

                              <table id="table-edit-anggota" class="table">
                                  <thead>
                                      <tr>
                                          <th style="display: none">ID</th>
                                          <th>NIK</th>
                                          <th>Nama Lengkap</th>
                                          <th>Status</th>
                                          <th width="10%" style="text-align: right">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                          <button type="submit" class="btn btn-success">
                              Perbarui Data
                          </button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <script>
          $(document).ready(function() {

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              var table = $('#tableKeluarga').DataTable({
                  processing: true,
                  serverSide: true,
                  searching: true,
                  select: true,
                  ajax: "{{ url('keluarga') }}",
                  //   dom: 'lBfrtip',
                  dom: "<'row'<'col-sm-5'l><'col-sm-7'f>>" +
                      "<'row'<'col-sm-12'tr>>" +
                      "<'row'<'col-sm-5'i><'col-sm-7'p>>B",
                  buttons: {
                      dom: {
                          button: {
                              className: 'btn btn-info mr-2' //Primary class for all buttons
                          }
                      },
                      buttons: [{
                              extend: "excelHtml5",
                              text: '<i class="bi bi-file-earmark-excel-fill"></i> Excel',
                              titleAttr: 'Excel',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                              },
                          },
                          {
                              extend: "pdfHtml5",
                              text: '<i class="bi bi-file-earmark-pdf-fill"></i> PDF',
                              titleAttr: 'PDF',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                              },
                          },
                          {
                              extend: 'print',
                              text: ' <i class="bi bi-printer-fill"></i> Print',
                              titleAttr: 'Print',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                              },
                          }
                      ],
                  },
                  order: [
                      [0, 'asc']
                  ],
                  columnDefs: [{
                      searchable: false,
                      orderable: false,
                      targets: [9]
                  }],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      {
                          data: "no_kk",
                          name: "No kk",
                      },
                      {
                          name: "Kepala Keluarga",
                          render: function(data, type, row, meta) {
                              var anggotas = row["anggota"];

                              for (let i = 0; i < anggotas.length; i++) {
                                  if (anggotas[i].status_anggota == "Kepala Keluarga") {
                                      return anggotas[i].nama_lengkap
                                  }
                              }
                              return '';
                          }
                      },
                      {
                          name: "Jumlah anggota",
                          render: function(data, type, row, meta) {

                              return row["anggota"].length + ' Orang';
                          }
                      },
                      {
                          data: "alamat",
                          name: "alamat",
                      },
                      {
                          data: "dusun",
                          name: "dusun",
                      },
                      {
                          data: "rt",
                          name: "rt",
                      },
                      {
                          data: "rw",
                          name: "rw",
                      },
                      {
                          data: "ekonomi",
                          name: "ekonomi",
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editModalKeluarga('${row["id"]}')">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteModal('${row["id"]}')">
                                    Hapus
                                </button>
                            </div>
                            `;
                          },
                      },
                  ]
              });

              table.buttons().container().appendTo("#printbar");
          });

          newModalKeluarga = () => {
              var rowCount = $("#table-anggota tr").length;
              if (rowCount == 1) {
                  $('#table-anggota').hide();
              }

              $('#input-anggota').select2({
                  theme: "bootstrap",
              });

          }

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

                  DataAnggota[index] = anggota;

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

                          $('#modalNewKeluarga .close').click();
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
                          });

                          //reload only datatable
                          $('#tableKeluarga').DataTable().ajax.reload();

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

          //modal edit data
          editModalKeluarga = (id) => {

              $("#form_edit_warga").find('.has-error').removeClass("has-error");
              $("#form_edit_warga").removeClass("is-invalid");

              //select warga
              $('#input-edit-anggota').select2({
                  theme: "bootstrap"
              });

              $("#table-edit-anggota tbody tr").remove();
              $('#table-edit-anggota').hide();

              var url = '{{ route('keluarga.show', ':id') }}';

              $.ajax({
                  url: url.replace(':id', id),
                  success: function(response) {

                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
                      }

                      var anggotas = response.anggota;
                      for (let i = 0; i < anggotas.length; i++) {
                          if (anggotas[i].status_anggota == "Kepala Keluarga") {
                              $("#button-edit-kepala").hide();
                          }


                          var markup =
                              `
                                <tr data-id="${anggotas[i].id}">
                                    <td style="display:none;">${anggotas[i].id}</td>
                                    <td>${ anggotas[i].no_ktp}</td>
                                    <td>${ anggotas[i].nama_lengkap}</td>
                                    <td>${ anggotas[i].status_anggota}</td>
                                    <td>
                                        <div class="float-right">
                                            <button type="button" class="btndeleterowaddedEdit btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                              `;
                          $("#table-edit-anggota tbody").append(markup);
                      }

                      $('#table-edit-anggota').show();

                  },
                  error: function(xhr, status, error) {
                      console.log(error);
                      //close modal
                      $('#modalEdit .close').click();

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
          };

          //add anggota
          addAnggotaEdit = (sebagai) => {
              var id_warga = $("#input-edit-anggota").val();
              if (id_warga == "-" || id_warga == undefined) {

              } else {

                  var status = (sebagai == 'kepala') ? 'Kepala Keluarga' : 'Anggota Keluarga';

                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id_warga),
                      success: function(response) {

                          var tr = $('#table-edit-anggota tr[data-id="' + response.id + '"]');


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
                                            <button type="button" class="btndeleterowaddedEdit btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </div>    
                                    </td>
                                </tr>
                              `;
                              $("#table-edit-anggota tbody").append(markup);
                              $('#table-edit-anggota').show();

                              if (sebagai == 'kepala') {
                                  $("#button-edit-kepala").hide();
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
                          $("#input-edit-anggota").val('').trigger('change')
                      },
                      error: function(xhr, status, error) {
                          var err = eval(xhr.responseJSON);
                          console.log(err.errors);

                          if (err.errors != undefined) {

                              //error validation
                              for (var obj in err.errors) {
                                  checkValidation(err.errors[obj], "input-edit-" + obj, "message-" +
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
          $(document).on('click', 'button.btndeleterowaddedEdit', function() {
              // get the current row
              var currentRow = $(this).closest("tr");

              // get current row 3rd TD
              var col3 = currentRow.find("td:eq(3)").text();
              if (col3 == 'Kepala Keluarga') {
                  $("#button-edit-kepala").show();
              }

              //hide table if no data
              var rowCount = $("#table-edit-anggota tr").length;
              if (rowCount == 2) {
                  $('#table-edit-anggota').hide();
              }


              $(this).closest('tr').remove();
              return false;
          });

          //update data
          $("#form_edit_keluarga").submit(function(event) {
              /* stop form from submitting normally */
              event.preventDefault();



              //get data  from table
              var DataAnggota = [];
              var checkKepalaKeluarga = false;
              $('#table-edit-anggota tr').each(function(index) {

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

                  DataAnggota[index] = anggota;
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
                  data_input.id = $("#input-edit-id").val();
                  data_input.no_kk = $("#input-edit-no_kk").val();
                  data_input.alamat = $("#input-edit-alamat").val();
                  data_input.dusun = $("#input-edit-dusun").val();
                  data_input.rt = $("#input-edit-rt").val();
                  data_input.rw = $("#input-edit-rw").val();
                  data_input.ekonomi = $("#input-edit-ekonomi").val();
                  data_input.anggotas = DataAnggota;

                  //console.log(data_input);


                  //reset validation
                  for (obj in data_input) {
                      $(`#input-edit-${obj}`).attr("class", "form-control is-valid");
                  }

                  $.ajax({
                      url: '{{ route('keluarga.update') }}',
                      method: 'POST',
                      dataType: 'json',
                      contentType: 'application/x-www-form-urlencoded',
                      data: data_input,
                      success: function(response) {
                          console.log(response);

                          //close modal
                          $('#modalEdit .close').click();
                          $("#form_edit_keluarga").trigger('reset');
                          $("#table-edit-anggota tr").remove();
                          $('#table-edit-anggota').hide();


                          //sweet alert message success
                          Swal.fire({
                              position: 'center',
                              icon: 'success',
                              title: `Success`,
                              text: `${response.message}`,
                              showConfirmButton: false,
                              timer: 2000
                          });

                          //reload only datatable
                          $('#tableKeluarga').DataTable().ajax.reload();

                      },
                      error: function(xhr, status, error) {
                          var err = eval(xhr.responseJSON);
                          console.log(err.errors);

                          if (err.errors != undefined) {

                              //error validation
                              for (var obj in err.errors) {
                                  checkValidation(err.errors[obj], "input-edit-" + obj,
                                      "message-edit-" +
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

          //delete 
          deleteModal = (id) => {

              //console.log(id);

              Swal.fire({
                  title: 'Hapus data',
                  text: `Yakin ingin menghapus data?`,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, hapus data!',
                  cancelButtonText: 'Batalkan'
              }).then((isDelete) => {
                  if (isDelete.isConfirmed) {

                      $.ajax({
                          url: "keluarga/delete/" + id,
                          method: 'DELETE',
                          contentType: 'application/x-www-form-urlencoded',
                          success: function(response) {

                              Swal.fire(
                                  'Deleted!',
                                  `${response.message}`,
                                  'success'
                              )

                              //reload only datatable
                              $('#tableKeluarga').DataTable().ajax.reload();
                          },
                          error: function(xhr, status, error) {
                              var err = eval(xhr.responseJSON);
                              console.log(err.errors);

                              //sweet alert message error
                              Swal.fire({
                                  position: 'center',
                                  icon: 'error',
                                  title: `${status}`,
                                  text: `${err.message}`,
                                  showConfirmButton: true
                              })
                          }
                      })
                  }
              })
          }


          function checkValidation(errorMsg, elementById, elementMsg) {
              if (errorMsg != undefined) {
                  document.getElementById(`${elementById}`).className = "form-control is-invalid";
                  $(`#${elementMsg}`).html(` ${errorMsg}`);
              } else {
                  document.getElementById(`${elementById}`).className = "form-control is-valid";
              }
          }
      </script>
  @endsection
