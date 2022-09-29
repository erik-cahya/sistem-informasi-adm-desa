  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item">Menu</li>
                  <li class="breadcrumb-item active">{{ $title }}</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">Daftar {{ $title }}</h5>

                          <div class="btn-group mb-3">
                              <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <i class="bx bx-plus"></i>&nbsp;Buat Surat
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{ route('surat.domisili') }}">Surat domisili</a></li>
                                  <li><a class="dropdown-item"
                                          href="{{ route('surat.keterangan_pekerjaan_orang_tua') }}">Surat pekerjaan orang
                                          tua</a></li>
                                  <li><a class="dropdown-item" href="{{ route('surat.keterangan_berlakuan_baik') }}">Surat
                                          berpelakuan baik</a></li>
                                  <li><a class="dropdown-item" href="{{ route('surat.keterangan_ekonomi_lemah') }}">Surat
                                          ekonomi lemah</a></li>
                                  <li><a class="dropdown-item"
                                          href="{{ route('surat.surat_keterangan_belum_menikah') }}">Surat belum menikah</a>
                                  </li>
                                  <li><a class="dropdown-item"
                                          href="{{ route('surat.surat_keterangan_kepemilikan') }}">Surat kepemilikan</a>
                                  </li>
                                  <li><a class="dropdown-item" href="{{ route('surat.surat_keterangan_usaha') }}">Surat
                                          keterangan usaha</a></li>
                              </ul>
                          </div>

                          <div id="printbar" style="float:right"></div>
                          <div class="table-responsive">
                              <table id="tablesurat" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>Jenis surat</th>
                                          <th>Nomor surat</th>
                                          <th>Tanggal surat</th>
                                          <th>File</th>
                                          <th width="12%" style="text-align: right">Aksi</th>
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
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editLabel">Edit data pengguna</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="form_edit_user" method="post">
                      @csrf
                      <div class="modal-body">
                          <input id="user_id" type="hidden" />

                          <div class="form-group">
                              <label for="input-edit-username">Username</label>
                              <input id="input-edit-username" type="text" class="form-control" value="">
                              <div class="invalid-feedback">
                                  <span id="message-edit-username"></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-email">Email</label>
                              <input id="input-edit-email" type="text" class="form-control" value="">
                              <div class="invalid-feedback">
                                  <span id="message-edit-email"></span>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="input-edit-status">Status Akun</label>
                              <select id="input-edit-status" class="form-control">
                                  <option value="0">Tidak Aktif</option>
                                  <option value="1">Aktif</option>
                              </select>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                          <button type="submit" class="btn btn-success">Update</button>
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

              var table = $('#tablesurat').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('surat') }}",
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
                                  columns: [0, 1, 2, 3]
                              },
                          },
                          {
                              extend: "pdfHtml5",
                              text: '<i class="bi bi-file-earmark-pdf-fill"></i> PDF',
                              titleAttr: 'PDF',
                              exportOptions: {
                                  columns: [0, 1, 2, 3]
                              },
                          },
                          {
                              extend: 'print',
                              text: ' <i class="bi bi-printer-fill"></i> Print',
                              titleAttr: 'Print',
                              exportOptions: {
                                  columns: [0, 1, 2, 3]
                              },
                          }
                      ],
                  },
                  aLengthMenu: [
                      [25, 50, 100, 200, -1],
                      [25, 50, 100, 200, "All"]
                  ],
                  order: [
                      [0, 'desc']
                  ],
                  columnDefs: [{
                      searchable: false,
                      orderable: false,
                      targets: [5]
                  }],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      {
                          data: "jenis_surat",
                          name: "jenis_surat",
                      },
                      {
                          data: "no_surat",
                          name: "no_surat",
                      },
                      {
                          data: "tanggal_surat",
                          name: "tanggal_surat",
                      },
                      {
                          render: function(data, type, row, meta) {
                              var url = '{{ route('surat.download', ':fileName') }}';
                              return `<a href="${url.replace(':fileName', row['nama_surat'])}">${row['nama_surat']}</a>`;
                          }
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right btn-group" role="group">
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteModalAccount('${row["id"]}')">
                                    Hapus
                                </button>
                            </div>
                            `;
                          },
                      },
                  ],
              });

              table.buttons().container().appendTo("#printbar");
          });

          //delete 
          deleteModalAccount = (id) => {

              //console.log(id);

              Swal.fire({
                  title: 'Hapus data',
                  text: `Yakin ingin menghapus data ?`,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, hapus data!',
                  cancelButtonText: 'Batalkan'
              }).then((isDelete) => {
                  if (isDelete.isConfirmed) {

                      var url = '{{ route('surat.delete', ':id') }}';
                      $.ajax({
                          url: url.replace(':id', id),
                          method: 'DELETE',
                          contentType: 'application/x-www-form-urlencoded',
                          success: function(response) {

                              Swal.fire(
                                  'Deleted!',
                                  `${response.message}`,
                                  'success'
                              )

                              //reload only datatable
                              $('#tablesurat').DataTable().ajax.reload();
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
