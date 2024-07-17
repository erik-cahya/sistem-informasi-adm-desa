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

                        <h5 class="card-title">List Pengajuan Surat</h5>

                        <div class="table-responsive">
                            <table id="tablesurat" class="display .datatable table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="6%">No</th>
                                        <th>Jenis surat</th>
                                        <th>Nama Lengkap</th>
                                        <th>Keterangan</th>
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
                ajax: "{{ url('list-pengajuan') }}",
                "oLanguage": {
                    "sSearch": "Cari"
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
                        data: "nama_lengkap",
                        name: "nama_lengkap",
                    },
                    {
                        data: "keterangan",
                        name: "keterangan",
                    },

                    {
                        render: function(data, type, row, meta) {
                            if (row['status'] === 'pending') {
                                return `
                                    <span class="badge bg-warning">${row['status']}</span>
                                `;
                            } else {
                                return `
                                    <span class="badge bg-success">${row['status']}</span>
                                `;
                            }


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

                    var url = "{{ route('pengajuan-surat.delete', ':id') }}";
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
