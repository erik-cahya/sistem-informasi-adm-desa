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

                          <h5 class="card-title">Daftar {{ $title }}</h5>

                          <div class="btn-group">
                          <div class="btn-group mb-3 mr-2">
                              <button type="button" class="btn btn-success dropdown-toggle rounded-1" data-bs-toggle="dropdown"
                                  aria-expanded="false">
                                  <i class="bx bx-plus"></i>&nbsp;Buat Mutasi
                              </button>
                              <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{ route('mutasi.masuk') }}">Mutasi masuk/lahir</a>
                                  </li>
                                  <li><a class="dropdown-item" href="{{ route('mutasi.keluar') }}">Mutasi keluar/wafat</a>
                                  </li>
                              </ul>
                          </div>

                          <div id="printbar" style="float:right" class="mb-3"></div>
                          </div>
                          <div class="table-responsive">
                              <table id="table_mutasi" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>NIK</th>
                                          <th>Nama Lengkap</th>
                                          <th>Jenis Mutasi</th>
                                          <th>Tanggal Mutasi</th>
                                          <th>Keterangan</th>
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
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editLabel">Edit data mutasi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="form_edit_mutasi" method="post">
                      @csrf
                      <div class="modal-body">
                          <input id="input-edit-id" type="hidden">

                          <div class="form-group">
                              <label for="input-edit-no_ktp">No KTP/ID</label>
                              <input id="input-edit-no_ktp" type="text" class="form-control" value="" readonly>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-no_ktp"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-nama_lengkap">Nama Lengkap</label>
                              <input id="input-edit-nama_lengkap" type="text" class="form-control" value=""
                                  readonly>

                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-nama_lengkap"></small>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="input-edit-jenis_mutasi">Jenis Mutasi</label>
                              <select id="input-edit-jenis_mutasi" class="form-control">
                                  <option value="" disabled>Pilih Jenis mutasi</option>
                                  @foreach ($tipeMutasi as $mut)
                                      <option value="{{ $mut }}">{{ $mut }}</option>
                                  @endforeach
                              </select>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-jenis_mutasi"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-tgl_keluar_masuk">Tanggal mutasi</label>
                              <input id="input-edit-tgl_keluar_masuk" type="date" class="form-control" value="">
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-tgl_keluar_masuk"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-keterangan">Keterangan</label>
                              <textarea id="input-edit-keterangan" class="form-control" style="height: 100px" value=""></textarea>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-keterangan"></small>
                              </div>
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

              var table = $('#table_mutasi').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('mutasi') }}",
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
                              text: '<i class="bi bi-file-earmark-excel-fill"></i> Download Data',
                              titleAttr: 'Excel',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5]
                              },
                          }
                      ],
                  },
                  "scrollX": true,
                  "oLanguage": {
                    "sSearch": "Cari"
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
                      targets: [6]
                  }],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      {
                          data: "no_ktp",
                          name: "no_ktp",
                      },
                      {
                          data: "nama_lengkap",
                          name: "nama_lengkap",
                      },
                      {
                          data: "jenis_mutasi",
                          name: "jenis_mutasi",
                      },
                      {
                          data: "tgl_keluar_masuk",
                          name: "tgl_keluar_masuk",
                      },
                      {
                          data: "keterangan",
                          name: "keterangan",
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right btn-group" role="group">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editModal('${row["id"]}')">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteModal('${row["id"]}')">
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

          //modal edit data
          editModal = (id) => {

              $("#form_edit_mutasi").find('.has-error').removeClass("has-error");
              $("#form_edit_mutasi").removeClass("is-invalid");

              var url = "{{ route('mutasi.show', ':id') }}";

              $.ajax({
                  url: url.replace(':id', id),
                  success: function(response) {

                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
                      }

                      //select option set value
                      document.querySelector('#input-edit-jenis_mutasi')
                          .options[response.jenis_mutasi.selectedIndex];
                  },
                  error: function(xhr, status, error) {
                      console.log(error);
                      //close modal
                      $('#modalEdit .close').click();

                      //sweet alert message error-id
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

          //update data
          $("#form_edit_mutasi").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = $("#input-edit-id").val()
              data_input.jenis_mutasi = $("#input-edit-jenis_mutasi").val();
              data_input.tgl_keluar_masuk = $("#input-edit-tgl_keluar_masuk").val();
              data_input.keterangan = $("#input-edit-keterangan").val();

              //reset validation
              for (obj in data_input) {
                  $(`#message-edit-${obj}`).html('');
              }

              $.ajax({
                  url: "{{ route('mutasi.update') }}",
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      //close modal
                      $('#modalEdit .close').click();
                      $("#form_edit_mutasi").trigger('reset');

                      //sweet alert message success
                      Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: `Success`,
                          text: `${response.message}`,
                          showConfirmButton: false,
                          timer: 2000
                      })

                      //reload only datatable
                      $('#table_mutasi').DataTable().ajax.reload();
                  },
                  error: function(xhr, status, error) {
                      var err = eval(xhr.responseJSON);
                      console.log(err.errors);

                      if (err.errors != undefined) {

                          //error validation
                          for (var obj in err.errors) {
                              checkValidation(err.errors[obj], "input-edit-" + obj, "message-edit-" +
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

          //delete 
          deleteModal = (id) => {

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

                      var url = "{{ route('mutasi.delete', ':id') }}";

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
                              $('#table_mutasi').DataTable().ajax.reload();
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
      </script>
  @endsection
