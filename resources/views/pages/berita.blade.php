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

                        @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                          <h5 class="card-title">Daftar {{ $title }}</h5>
                          
                          <div class="btn-group">
                          <div class="btn-group mb-3 mr-2">
                              <a href="{{ route('berita.add') }}" class="btn btn-success mb-4 mr-2 rounded-1"> <i class="bx bx-plus"></i>&nbsp;Tambah Berita</a>
                          </div>

                            

                          <div id="printbar" style="float:right"></div>
                          </div>
                          <div class="table-responsive">
                              <table id="tableberita" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>Foto</th>
                                          <th>Judul</th>
                                          <th>Kategori</th>
                                          <th>Pembuat</th>
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

      <script>
          $(document).ready(function() {

            setTimeout(function() {
                $('.alert-dismissible').fadeOut('slow');}, 1000
            );

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              var table = $('#tableberita').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('berita') }}",
                    "oLanguage": {
                    "sSearch": "Cari"
                   },
                  aLengthMenu: [
                      [25, 50,  -1],
                      [25, 50,  "All"]
                  ],
                  order: [
                      [0, 'desc']
                  ],
                  columnDefs: [{
                      searchable: false,
                      orderable: false,
                      targets: [0]
                  }],
                    columns: [
                        {
                          render: function(data, type, row, meta) {
                              return meta.row + meta.settings._iDisplayStart + 1;
                          }
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <img src="storage/images/${row["thumbnail"]}" width="100px;">
                            `;
                          },
                      },
                      {
                          data: "judul",
                          name: "judul",
                      },
                      {
                          data: "nama",
                          name: "kategori",
                      },
                      {
                          data: "creator",
                          name: "creator",
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right btn-group" role="group">
                                <a href="berita/edit/${row["id"]}" class="btn btn-success btn-sm">Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteModalAccount('${row["id"]}', '${row["nama"]}')">
                                    Hapus
                                </button>
                            </div>
                            `;
                          },
                      },
                  ],
              });

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

                      var url = "{{ route('berita.delete', ':id') }}";
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
                              $('#tableberita').DataTable().ajax.reload();
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

          //modal edit data
          editModalKategori = (id) => {

              $("#form_edit_kategori").find('.has-error').removeClass("has-error");
              $("#form_edit_kategori").removeClass("is-invalid");

              var url = "{{ route('kategori.show', ':id') }}";
              $.ajax({
                  url: url.replace(':id', id),
                  success: function(response) {
                      console.log(response[0]);
                      $('#kategori_id').val(`${response.id}`);

                      //set value
                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
                          $(`#message-edit-${key}`).html('');
                      }

                      //select option set value
                      document.querySelector('#input-edit-nama')
                          .options[response.nama.selectedIndex];
                      
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

        //Create Data
          $("#form_new_kategori").submit(function(event) {

              event.preventDefault();

              var data_input = new Object();
              data_input.nama = $("#nama").val();

               //reset validation
              for (obj in data_input) {
                  $(`#message-${obj}`).html('');
              }

                $.ajax({
                    url: "{{ route('kategori.create') }}",
                    method: 'POST',
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    data: data_input,
                    success: function(response) {
                    // console.log(response);

                    //close modal
                    $('#modalNewKategori .close').click();
                    $("#form_new_kategori").trigger('reset');
                    


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
                    $('#tablekategori').DataTable().ajax.reload();
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

          //update data
          $("#form_edit_kategori").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = $("#kategori_id").val()
              data_input.nama = $("#input-edit-nama").val();

              //console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#message-edit-${obj}`).html('');
              }

              $.ajax({
                  url: "{{ route('kategori.update') }}",
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      //console.log(response);

                      //close modal
                      $('#modalEdit .close').click();
                      $("#form_edit_kategori").trigger('reset');

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
                      $('#tablekategori').DataTable().ajax.reload();
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
      </script>
  @endsection
