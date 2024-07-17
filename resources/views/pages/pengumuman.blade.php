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
                              <a href="{{ route('pengumuman.add') }}" class="btn btn-success mb-4 mr-2 rounded-1"> <i class="bx bx-plus"></i>&nbsp;Tambah Pengumuman</a>
                          </div>

                            

                          <div id="printbar" style="float:right"></div>
                          </div>
                          <div class="table-responsive">
                              <table id="tablepengumuman" class="display .datatable table table-hover" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="6%">No</th>
                                          <th>Judul</th>
                                          <th>Pengumuman</th>
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

              var table = $('#tablepengumuman').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('pengumuman') }}",
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
                          data: "judul",
                          name: "judul",
                      },
                      {
                          data: "pengumuman",
                          name: "pengumuman",
                      },
                      {
                          data: "creator",
                          name: "creator",
                      },
                      {
                          render: function(data, type, row, meta) {
                              return `
                            <div class="float-right btn-group" role="group">
                                <a href="pengumuman/edit/${row["id"]}" class="btn btn-success btn-sm">Edit
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

                      var url = "{{ route('pengumuman.delete', ':id') }}";
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
                              $('#tablepengumuman').DataTable().ajax.reload();
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
          };
      </script>
  @endsection
