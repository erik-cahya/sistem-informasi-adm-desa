  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h1>{{ $title }}</h1>
          <nav>
              <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Pengaturan</a></li>
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

                          {{-- Dev Only --}}
                          {{-- <button type="button" class="btn btn-success mb-4" data-toggle="modal"
                              data-target="#modalNewParams"> <i class="bx bx-plus"></i>&nbsp;Buat Baru</button> --}}

                          <div id="modalNewParams" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                      <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel">Buat parameter baru</h4>
                                          <button type="button" class="close" data-dismiss="modal">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <form id="form_new_param" method="post">
                                          @csrf
                                          <div class="modal-body">

                                              <div class="form-group">
                                                  <label for="input-param">Parameter</label>
                                                  <input id="input-param" type="text" class="form-control"
                                                      value="">
                                                  <div class="invalid-feedback">
                                                      <span id="message-param"></span>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-value">Value</label>
                                                  <input id="input-value" type="text" class="form-control"
                                                      value="">
                                                  <div class="invalid-feedback">
                                                      <span id="message-value"></span>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-keterangan">keterangan</label>
                                                  <input id="input-keterangan" type="text" class="form-control"
                                                      value="">
                                                  <div class="invalid-feedback">
                                                      <span id="message-keterangan"></span>
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
                              <table id="tableparams" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>Parameter</th>
                                          <th>Value</th>
                                          <th>Keterangan</th>
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
                      <h5 class="modal-title" id="editLabel">Edit data paramter</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="form_data_param" method="post">
                      @csrf
                      <div class="modal-body">
                          <input id="param_id" type="hidden" />

                          <div class="form-group hide">
                              <label for="input-edit-param">parameter</label>
                              <input id="input-edit-param" type="text" class="form-control" disabled>
                              <div class="invalid-feedback">
                                  <span id="message-edit-param"></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-value">value</label>
                              <input id="input-edit-value" type="text" class="form-control" value="">
                              <div class="invalid-feedback">
                                  <span id="message-edit-value"></span>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-keterangan">keterangan</label>
                              <input id="input-edit-keterangan" type="text" class="form-control" value="">
                              <div class="invalid-feedback">
                                  <span id="message-edit-keterangan"></span>
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

              var table = $('#tableparams').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('parameter') }}",
                  //   dom: 'lBfrtip',
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
                          data: "param",
                          name: "param",
                      },
                      {
                          data: "value",
                          name: "value",
                      },
                      {
                          data: "keterangan",
                          name: "keterangan"
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
          $("#form_new_param").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.param = $("#input-param").val();
              data_input.value = $("#input-value").val();
              data_input.keterangan = $("#input-keterangan").val();

              //reset validation
              for (obj in data_input) {
                  $(`#input-${obj}`).attr("class", "form-control is-valid");
              }

              $.ajax({
                  url: '{{ route('parameter.create') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      // console.log(response);

                      //close modal
                      $('#modalNewParams .close').click();
                      $("#form_new_param").trigger('reset');

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
                      $('#tableparams').DataTable().ajax.reload();
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

              $("#form_data_param").find('.has-error').removeClass("has-error");
              $("#form_data_param").removeClass("is-invalid");

              var url = '{{ route('parameter.show', ':id') }}';
              $.ajax({
                  url: url.replace(':id', id),
                  success: function(response) {

                      $('#param_id').val(`${response.id}`);

                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
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
          $("#form_data_param").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = $("#param_id").val();
              data_input.param = $("#input-edit-param").val();
              data_input.value = $("#input-edit-value").val();
              data_input.keterangan = $("#input-edit-keterangan").val();

              console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#input-edit-${obj}`).attr("class", "form-control is-valid");
              }

              $.ajax({
                  url: '{{ route('parameter.update') }}',
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      //console.log(response);

                      //close modal
                      $('#modalEdit .close').click();
                      $("#form_data_param").trigger('reset');

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
                      $('#tableparams').DataTable().ajax.reload();
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

                      var url = '{{ route('parameter.delete', ':id') }}';
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
                              $('#tableparams').DataTable().ajax.reload();
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
