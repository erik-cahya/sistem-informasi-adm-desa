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

                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-no_kk"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-alamat">Alamat</label>
                                                  <input id="input-alamat" type="text"
                                                      class="form-control form-control-sm" value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-alamat"></small>
                                                  </div>
                                              </div>

                                              <div class="row">
                                                  <div class="form-group col-md-4">
                                                      <label for="input-dusun">Dusun</label>
                                                      <select id="input-dusun" class="form-control form-control-sm">
                                                          <option value="" selected disabled></option>
                                                          @foreach ($dusuns as $dusun)
                                                              <option value="{{ $dusun }}">{{ $dusun }}
                                                              </option>
                                                          @endforeach
                                                      </select>
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-dusun"></small>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                      <label for="input-rt">RT</label>
                                                      <input id="input-rt" type="text"
                                                          class="form-control form-control-sm" value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-rt"></small>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                      <label for="input-rw">RW</label>
                                                      <input id="input-rw" type="text"
                                                          class="form-control form-control-sm" value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-rw"></small>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-ekonomi">Status Ekonomi</label>
                                                  <select id="input-ekonomi" class="form-control form-control-sm">
                                                      <option value="" selected disabled></option>
                                                      @foreach ($ekonomis as $ekonomi)
                                                          <option value="{{ $ekonomi }}">{{ $ekonomi }}
                                                          </option>
                                                      @endforeach
                                                  </select>
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-ekonomi"></small>
                                                  </div>
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
                                                                  onclick="addAnggota('Kepala Keluarga')">Kepala
                                                                  Keluarga</a>
                                                          </li>
                                                          <li>
                                                              <a id="button-istri" class="dropdown-item"
                                                                  onclick="addAnggota('Istri')">Istri</a>
                                                          </li>
                                                          <li>
                                                              <a id="button-anak" class="dropdown-item"
                                                                  onclick="addAnggota('Anak')">Anak</a>
                                                          </li>
                                                          <li>
                                                              <a id="button-aa" class="dropdown-item"
                                                                  onclick="addAnggota('AA')">AA</a>
                                                          </li>
                                                          <li>
                                                              <a id="button-p" class="dropdown-item"
                                                                  onclick="addAnggota('P')">P</a>
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
                          <div id="toggle" class="mb-3 border-1">
                              <p>Klik untuk menampilkan kolom:</p>
                              <a class="toggle-vis badge bg-primary" data-column="1">No KK</a>
                              <a class="toggle-vis badge bg-primary" data-column="2">Kepala keluarga</a>
                              <a class="toggle-vis badge bg-primary" data-column="3">Jumlah anggota</a>
                              <a class="toggle-vis badge bg-secondary" data-column="4">Alamat</a>
                              <a class="toggle-vis badge bg-secondary" data-column="5">Dusun</a>
                              <a class="toggle-vis badge bg-secondary" data-column="6">RT</a>
                              <a class="toggle-vis badge bg-secondary" data-column="7">RW</a>
                              <a class="toggle-vis badge bg-secondary" data-column="8">Ekonomi</a>
                          </div>
                          <div class="table-responsive">
                              <table id="tableKeluarga" class="display .datatable table table-bordered"
                                  style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="12px">No</th>
                                          <th>No KK</th>
                                          <th>Kepala keluarga</th>
                                          <th>Jumlah anggota</th>
                                          <th>Alamat</th>
                                          <th>Dusun</th>
                                          <th>RT</th>
                                          <th>RW</th>
                                          <th>Ekonomi</th>
                                          <th>Detail</th>
                                          <th>Aksi</th>
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

                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-no_kk"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-alamat">Alamat</label>
                              <input id="input-edit-alamat" type="text" class="form-control form-control-sm"
                                  value="">
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-alamat"></small>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-4">
                                  <label for="input-edit-dusun">Dusun</label>
                                  <select id="input-edit-dusun" class="form-control form-control-sm">
                                      <option value="" selected disabled></option>
                                      @foreach ($dusuns as $dusun)
                                          <option value="{{ $dusun }}">{{ $dusun }}
                                          </option>
                                      @endforeach
                                  </select>
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-dusun"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="input-edit-rt">RT</label>
                                  <input id="input-edit-rt" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-rt"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="input-edit-rw">RW</label>
                                  <input id="input-edit-rw" type="text" class="form-control form-control-sm"
                                      value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-rw"></small>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-ekonomi">Status Ekonomi</label>
                              <select id="input-edit-ekonomi" class="form-control form-control-sm">
                                  @foreach ($ekonomis as $ekonomi)
                                      <option value="{{ $ekonomi }}">{{ $ekonomi }}
                                      </option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label for="table-edit-anggota">Daftar Anggota</label>

                              <div class="d-flex flex-row">
                                  <select id="input-edit-anggota"
                                      class="js-example-placeholder-single js-states form-control form-control-sm"
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
                                              onclick="addAnggotaEdit('Kepala Keluarga')">Kepala
                                              Keluarga</a>
                                      </li>
                                      <li>
                                          <a id="button-edit-istri" class="dropdown-item"
                                              onclick="addAnggotaEdit('Istri')">Istri</a>
                                      </li>
                                      <li>
                                          <a id="button-edit-anak" class="dropdown-item"
                                              onclick="addAnggotaEdit('Anak')">Anak</a>
                                      </li>
                                      <li>
                                          <a id="button-edit-aa" class="dropdown-item"
                                              onclick="addAnggotaEdit('AA')">AA</a>
                                      </li>
                                      <li>
                                          <a id="button-edit-p" class="dropdown-item" onclick="addAnggotaEdit('P')">P</a>
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
          function format(d) {
              var anggotas = d.anggota;
              var tableHead =
                  `
                <table id="tableDetails" class="display .datatable table table-hover table-bordered"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th>No KTP</th>
                            <th>Nama lengkap</th>
                            <th>Status dalam keluarga</th>
                        </tr>
                    </thead>
                    <tbody>`;

              body = [];
              for (let i = 0; i < anggotas.length; i++) {

                  body[i] = `
                         <tr>
                            <td>${ anggotas[i].no_ktp}</td>
                            <td>${ anggotas[i].nama_lengkap}</td>
                            <td>${ anggotas[i].status_anggota}</td>
                        </tr>
                        `;
              }

              var tableFoot = `
                    </tbody>
                </table>
                `;



              return (tableHead +
                  body.join('') +
                  tableFoot);
          }



          $(document).ready(function() {

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              //search by column
              $('#tableKeluarga thead tr').clone(true).appendTo('#tableKeluarga thead');
              $('#tableKeluarga thead tr:eq(1) th').each(function(i) {
                  var title = $(this).text();
                  var index = $(this).index();
                  if (index === 0 || index === 9 || index === 10) {
                      $(this).html('');
                      return;
                  }
                  $(this).html(
                      '<input type="text" class="form-control form-control-sm" placeholder="Cari ' +
                      title + '" >');

                  $('input', this).on('keyup change', function() {
                      if (table.column(i).search() !== this.value) {
                          table
                              .column(i)
                              .search(this.value)
                              .draw();
                      }
                  });
              });

              var table = $('#tableKeluarga').DataTable({
                  processing: true,
                  serverSide: true,
                  orderCellsTop: true,
                  fixedHeader: true,
                  select: true,
                  ajax: "{{ url('keluarga') }}",
                  //   dom: 'lBfrtip',
                  "scrollX": true,
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
                  aLengthMenu: [
                      [10, 25, 50, 100, -1],
                      [10, 25, 50, 100, "All"]
                  ],
                  order: [
                      [0, 'desc']
                  ],
                  columnDefs: [{
                          searchable: false,
                          orderable: false,
                          targets: [10]
                      },
                      {
                          visible: false,
                          target: [4, 5, 6, 7, 8],
                      }
                  ],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return `<b>${meta.row + meta.settings._iDisplayStart + 1}</b> `;
                          }
                      },
                      {
                          data: "no_kk",
                          name: "no_kk",
                      },
                      {
                          data: "kepala_keluarga",
                          name: "kepala_keluarga",
                      },
                      {
                          name: "jumlah_anggota",
                          render: function(data, type, row, meta) {
                              return row["jumlah_anggota"] + ' Orang';
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
                          className: 'dt-control',
                          orderable: false,
                          data: null,
                          defaultContent: ''
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right btn-group" role="group">
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

              //display column toggle
              $('a.toggle-vis').css("text-decoration", "none");
              $('a.toggle-vis').css("color", "#ffff");
              $('a.toggle-vis').css("cursor", "pointer");

              $('a.toggle-vis').on('click', function(e) {
                  e.preventDefault();

                  // Get the column API object
                  var column = table.column($(this).attr('data-column'));

                  // Toggle the visibility
                  column.visible(
                      !column.visible()
                  );

                  console.log();
                  if ($(this).hasClass('toggle-vis badge bg-primary') != false) {
                      $(this).removeClass('bg-primary');
                      $(this).addClass('bg-secondary');
                  } else {
                      $(this).addClass('bg-primary');
                      $(this).removeClass('bg-secondary');
                  }
              });

              // Add event listener for opening and closing details
              $('#tableKeluarga tbody').on('click', 'td.dt-control', function() {
                  var tr = $(this).closest('tr');
                  var row = table.row(tr);

                  if (row.child.isShown()) {
                      // This row is already open - close it
                      row.child.hide();
                      tr.removeClass('shown');
                  } else {
                      // Open this row
                      row.child(format(row.data())).show();
                      tr.addClass('shown');
                  }
              });
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

                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id_warga),
                      success: function(response) {

                          if (response.no_kk != null) {
                              Swal.fire({
                                  position: 'center',
                                  icon: 'warning',
                                  title: `Upss...`,
                                  text: `${response.nama_lengkap} sudah terdaftar pada No KK ${response.no_kk}`,
                                  showConfirmButton: true
                              });
                          } else {

                              var tr = $('#table-anggota tr[data-id="' + response.id + '"]');


                              if (!tr.length) {
                                  var markup =
                                      `
                                <tr data-id="${response.id}">
                                    <td style="display:none;">${response.id}</td>
                                    <td>${ response.no_ktp}</td>
                                    <td>${ response.nama_lengkap}</td>
                                    <td>${ sebagai}</td>
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

                                  if (sebagai == 'Kepala Keluarga') {
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
                              $("#input-anggota").val('').trigger('change');
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
                      $(`#message-${obj}`).html('');
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

                      //select option set value
                      document.querySelector('#input-edit-dusun')
                          .options[response.dusun.selectedIndex];
                      document.querySelector('#input-edit-ekonomi')
                          .options[response.ekonomi.selectedIndex];

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

                  var url = '{{ route('warga.show', ':id') }}';

                  $.ajax({
                      url: url.replace(':id', id_warga),
                      success: function(response) {

                          var tr = $('#table-edit-anggota tr[data-id="' + response.id + '"]');

                          if (!tr.length) {
                              if (response.no_kk != null) {
                                  Swal.fire({
                                      position: 'center',
                                      icon: 'warning',
                                      title: `Upss...`,
                                      text: `${response.nama_lengkap} sudah terdaftar pada No KK ${response.no_kk}`,
                                      showConfirmButton: true
                                  });
                              } else {

                                  var markup =
                                      `
                                            <tr data-id="${response.id}">
                                                <td style="display:none;">${response.id}</td>
                                                <td>${ response.no_ktp}</td>
                                                <td>${ response.nama_lengkap}</td>
                                                <td>${ sebagai}</td>
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

                                  if (sebagai == 'Kepala Keluarga') {
                                      $("#button-edit-kepala").hide();
                                  };
                              }
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
                      $(`#message-${obj}`).html('');
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
              document.getElementById(`${elementById}`).className = "form-control";
              $(`#${elementMsg}`).html(` ${errorMsg}`);
          }


          function exportTableToCSV($table, filename) {

              //rescato los títulos y las filas
              var $Tabla_Nueva = $table.find('tr:has(td,th)');
              // elimino la tabla interior.
              var Tabla_Nueva2 = $Tabla_Nueva.filter(function() {
                  return (this.childElementCount != 1);
              });

              var $rows = Tabla_Nueva2,
                  // Temporary delimiter characters unlikely to be typed by keyboard
                  // This is to avoid accidentally splitting the actual contents
                  tmpColDelim = String.fromCharCode(11), // vertical tab character
                  tmpRowDelim = String.fromCharCode(0), // null character

                  // Solo Dios Sabe por que puse esta linea
                  colDelim = (filename.indexOf("xls") != -1) ? '"\t"' : '","',
                  rowDelim = '"\r\n"',


                  // Grab text from table into CSV formatted string
                  csv = '"' + $rows.map(function(i, row) {
                      var $row = $(row);
                      var $cols = $row.find('td:not(.hidden),th:not(.hidden)');

                      return $cols.map(function(j, col) {
                          var $col = $(col);
                          var text = $col.text().replace(/\./g, '');
                          return text.replace('"', '""'); // escape double quotes

                      }).get().join(tmpColDelim);
                      csv = csv + '"\r\n"' + 'fin ' + '"\r\n"';
                  }).get().join(tmpRowDelim)
                  .split(tmpRowDelim).join(rowDelim)
                  .split(tmpColDelim).join(colDelim) + '"';


              download_csv(csv, filename);


          }



          function download_csv(csv, filename) {
              var csvFile;
              var downloadLink;

              // CSV FILE
              csvFile = new Blob([csv], {
                  type: "text/csv"
              });

              // Download link
              downloadLink = document.createElement("a");

              // File name
              downloadLink.download = filename;

              // We have to create a link to the file
              downloadLink.href = window.URL.createObjectURL(csvFile);

              // Make sure that the link is not displayed
              downloadLink.style.display = "none";

              // Add the link to your DOM
              document.body.appendChild(downloadLink);

              // Lanzamos
              downloadLink.click();
          }
      </script>
  @endsection
