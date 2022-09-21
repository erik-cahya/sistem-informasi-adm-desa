  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>Akun Pengguna</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Pengaturan</a></li>
                  <li class="breadcrumb-item active">Akun Pengguna</li>
              </ol>
          </nav>
      </div><!-- End Page Title -->

      <section class="section">
          <div class="row">
              <div class="col-lg-12">

                  <div class="card">
                      <div class="card-body">

                          <h5 class="card-title">Daftar Akun Pengguna</h5>

                          <button type="button" class="btn btn-success mb-4" data-toggle="modal"
                              data-target="#modalNewUser"> <i class="bx bx-plus"></i>&nbsp;Buat Baru</button>

                          <div id="modalNewUser" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                      <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel">Buat Pengguna baru</h4>
                                          <button type="button" class="close" data-dismiss="modal">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <form id="form_new_user" method="post">
                                          @csrf
                                          <div class="modal-body">

                                              <div class="form-group">
                                                  <label for="input-username">Username</label>
                                                  <input id="input-username" type="text" class="form-control"
                                                      value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-username"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-email">Email</label>
                                                  <input id="input-email" type="text" class="form-control"
                                                      value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-email"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-password">password</label>
                                                  <input id="input-password" type="text" class="form-control"
                                                      value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-password"></small>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-dismiss="modal">Keluar</button>
                                              <button type="submit" class="btn btn-success">Simpan</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div id="printbar" style="float:right"></div>
                          <div class="table-responsive">
                              <table id="tableuser" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>Username</th>
                                          <th>Email</th>
                                          <th>Status</th>
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
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-username"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-email">Email</label>
                              <input id="input-edit-email" type="text" class="form-control" value="">
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-email"></small>
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

              var table = $('#tableuser').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('user') }}",
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
                      [0, 'asc']
                  ],
                  columnDefs: [{
                      searchable: false,
                      orderable: false,
                      targets: [4]
                  }],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      {
                          data: "username",
                          name: "username",
                      },
                      {
                          data: "email",
                          name: "email",
                      },
                      {
                          data: "status",
                          name: "status",
                          render: function(data, type, row, meta) {
                              if (data == "1") {
                                  return `<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif</span>`
                              } else {
                                  return `<span class="badge bg-danger"><i class="bi bi-exclamation-octagon me-1"></i> Tidak Aktif</span>`
                              }
                          }
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editModalUser('${row["id"]}')">
                                    Ubah
                                </button>
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


          //Create Data
          $("#form_new_user").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.username = $("#input-username").val();
              data_input.email = $("#input-email").val();
              data_input.password = $("#input-password").val();
              data_input.status = 1;

              //console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#message-${obj}`).html('');
              }

              $.ajax({
                  url: '{{ route('user.create') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      // console.log(response);

                      //close modal
                      $('#modalNewUser .close').click();
                      $("#form_new_user").trigger('reset');

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
                      $('#tableuser').DataTable().ajax.reload();
                  },
                  error: function(xhr, status, error) {
                      var err = eval(xhr.responseJSON);
                      console.log(err.errors);

                      if (err.errors != undefined) {

                          //error validation
                          for (var obj in err.errors) {
                              checkValidation(err.errors[obj], "input-" + obj, "message-" + obj);
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

          //modal edit data
          editModalUser = (id) => {

              $("#form_edit_user").find('.has-error').removeClass("has-error");
              $("#form_edit_user").removeClass("is-invalid");


              $.ajax({
                  url: "users/" + id,
                  success: function(response) {
                      //console.log(response);

                      $('#user_id').val(`${response.id}`);

                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
                          $(`#message-edit-${key}`).html('');
                      }

                      //Checkboxes 
                      //   $.each(response.status, function(key, val) {
                      //       document.getElementById(`${val.roleId}-edit`).checked = true;
                      //   });

                      //select option
                      if (response.status == "1") {
                          document.querySelector('#input-edit-status').options[1].selected = true;
                      } else {
                          document.querySelector('#input-edit-status').options[0].selected = true;
                      }
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
          }

          //update data
          $("#form_edit_user").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = $("#user_id").val();
              data_input.username = $("#input-edit-username").val();
              data_input.email = $("#input-edit-email").val();
              data_input.status = $("#input-edit-status").val();

              //console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#message-edit-${obj}`).html('');
              }

              $.ajax({
                  url: '{{ route('user.update') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      //console.log(response);

                      //close modal
                      $('#modalEdit .close').click();
                      $("#form_edit_user").trigger('reset');

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
                      $('#tableuser').DataTable().ajax.reload();
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

                      $.ajax({
                          url: "users/delete/" + id,
                          method: 'DELETE',
                          contentType: 'application/x-www-form-urlencoded',
                          success: function(response) {

                              Swal.fire(
                                  'Deleted!',
                                  `${response.message}`,
                                  'success'
                              )

                              //reload only datatable
                              $('#tableuser').DataTable().ajax.reload();
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
