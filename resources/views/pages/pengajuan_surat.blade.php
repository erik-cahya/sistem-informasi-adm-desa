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

                        <div class="btn-group">
                            <div class="btn-group mb-3 mr-2">
                                <button type="button" class="btn btn-success dropdown-toggle rounded-1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-plus"></i>&nbsp;Buat Surat
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('surat.domisili') }}">Surat domisili</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('surat.keterangan_pekerjaan_orang_tua') }}">Surat pekerjaan
                                            orang
                                            tua</a></li>
                                    <li><a class="dropdown-item" href="{{ route('surat.keterangan_berlakuan_baik') }}">Surat
                                            berpelakuan baik</a></li>
                                    <li><a class="dropdown-item" href="{{ route('surat.keterangan_ekonomi_lemah') }}">Surat
                                            ekonomi lemah</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('surat.surat_keterangan_belum_menikah') }}">Surat belum
                                            menikah</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('surat.surat_keterangan_kepemilikan') }}">Surat kepemilikan</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('surat.surat_keterangan_usaha') }}">Surat
                                            keterangan usaha</a></li>
                                </ul>
                            </div>

                            <div id="printbar" style="float:right"></div>
                        </div>
                        <div class="table-responsive">
                            <table id="tablesurat" class="display .datatable table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="6%">No</th>
                                        <th>Jenis surat</th>
                                        <th>Nama Pemohon</th>
                                        <th>Nama Surat</th>
                                        <th>Tanggal Permohonan</th>
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
    <div class="modal fade" id="form_edit_pengajuan_surat" tabindex="-1" role="dialog" aria-labelledby="editLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editLabel">Edit data pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_surat" method="post">
                    @csrf
                    <div class="modal-body">
                        <input id="input-edit-id" type="hidden">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-edit-no_ktp">No KTP/ID</label>
                                <input id="input-edit-no_ktp" type="text" class="form-control" value="" disabled>
                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-no_ktp"></small>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input-edit-jenis_surat">Jenis Surat</label>
                                <input id="input-edit-jenis_surat" type="text" class="form-control"
                                    list="list-jenis_surat" value="" disabled>

                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-jenis_surat"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-edit-nama_lengkap">Nama Lengkap Pemohon</label>
                                <input id="input-edit-nama_lengkap" type="text" class="form-control" value=""
                                    disabled>
                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-nama_lengkap"></small>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input-edit-nama_surat">Nama Surat</label>
                                <input id="input-edit-nama_surat" type="text" class="form-control" list="list-nama_surat"
                                    value="" disabled>

                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-nama_surat"></small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-edit-status">Status</label>
                                <select id="input-edit-status" class="form-control custom-select">
                                    <option value="disetujui">Disetujui</option>
                                    <option value="pending">Pending</option>
                                </select>
                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-status"></small>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="input-edit-no_wa">No WhatsApp</label>
                                <input id="input-edit-no_wa" type="text" class="form-control" value=""
                                    disabled>
                                <div class="text-danger font-italic text-capital">
                                    <small id="message-edit-no_wa"></small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input-edit-keterangan">Keterangan</label>
                            <textarea id="input-edit-keterangan" class="form-control" style="height: 100px" value="" disabled></textarea>
                            <div class="text-danger font-italic text-capital">
                                <small id="message-edit-keterangan"></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="input-edit-status">Document KK</label>
                                <img id="image1" alt="" width="200rem">
                            </div>

                            <div class="form-group
                                    col-md-6">
                                <label for="input-edit-no_wa">Document KTP</label>
                                <img id="image2" alt="" width="200rem">
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

            var table = $('#tablesurat').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('pengajuan-surat') }}",
                "oLanguage": {
                    "sSearch": "Cari"
                },
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
                            columns: [0, 1, 2, 3]
                        },
                    }],
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
                            console.log(row);
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
                        data: "nama_surat",
                        name: "nama_surat",
                    },
                    {
                        data: "created_at",
                        name: "created_at",
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
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#form_edit_pengajuan_surat" onclick="editModal('${row["id"]}')">
                                        Lihat Detail
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

            $("#form_edit_pengajuan_surat").find('.has-error').removeClass("has-error");
            $("#form_edit_pengajuan_surat").removeClass("is-invalid");

            var url = "{{ route('pengajuan-surat.show', ':id') }}";

            $.ajax({
                url: url.replace(':id', id),
                success: function(response) {
                    console.log(response.document1);
                    for (key in response) {
                        $('#input-edit-' + key).val(`${response[key]}`);
                    }

                    //select option set value
                    document.querySelector('#input-edit-status')
                        .options[response.status.selectedIndex];

                    // Show document images
                    document.getElementById("image1").setAttribute("src",
                        `{{ asset('storage/surat-images/${response.document1}') }}`);

                    document.getElementById("image2").setAttribute("src",
                        `{{ asset('storage/surat-images/${response.document2}') }}`);

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
        $("#form_edit_surat").submit(function(event) {

            /* stop form from submitting normally */
            event.preventDefault();

            var data_input = new Object();
            data_input.id = $("#input-edit-id").val()
            data_input.status = $("#input-edit-status").val();

            //reset validation
            for (obj in data_input) {
                $(`#message-edit-${obj}`).html('');
            }

            $.ajax({
                url: "{{ route('pengajuan-surat.update') }}",
                method: 'POST',
                dataType: 'json',
                contentType: 'application/x-www-form-urlencoded',
                data: data_input,
                success: function(response) {
                    //close modal
                    $('#modalEdit .close').click();
                    $("#form_edit_surat").trigger('reset');

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
                    $('#tablesurat').DataTable().ajax.reload();
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

                    var url = "{{ route('surat.delete', ':id') }}";
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
