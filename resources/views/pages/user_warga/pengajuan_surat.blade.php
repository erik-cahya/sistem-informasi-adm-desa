@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>{{ $title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Menu</li>
                <li class="breadcrumb-item">Buat Surat</li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title text-uppercase">Form Pengajuan Surat</h5>

                        <form method="POST" enctype="multipart/form-data" action="{{ route('pengajuan-surat.create') }}">
                            @csrf

                            <div class="modal-body">

                                <div class="row mb-3">
                                    <label for="input-id" class="col-sm-2 col-form-label">Jenis Surat</label>
                                    <div class="col-sm-10">
                                        <select id="input-id" class="js-example-placeholder-single js-states form-control"
                                            style=" display:block; width:100%;" name="jenis_surat">
                                            <option value="" disabled selected>Pilih layanan surat yang ingin diajukan
                                            </option>
                                            <option value="Surat Domisili">Surat Domisili</option>
                                            <option value="Surat Pekerjaan Orang Tua">Surat Pekerjaan Orang Tua</option>
                                            <option value="Surat Bepelakuan Baik">Surat Bepelakuan Baik</option>
                                            <option value="Surat Ekonomi Lemah">Surat Ekonomi Lemah</option>
                                            <option value="Surat Belum Menikah">Surat Belum Menikah</option>
                                            <option value="Surat Kepemilikan">Surat Kepemilikan</option>
                                            <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <span id="message-id"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="nama_surat" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input id="nama_surat" type="text" class="form-control form-control-sm"
                                            value="" name="nama_surat">
                                        <div class="invalid-feedback">
                                            <span id="message-pembuat_nama"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_wa" class="col-sm-2 col-form-label">No WA</label>
                                    <div class="col-sm-10">
                                        <input id="no_wa" type="text" class="form-control form-control-sm"
                                            name="no_wa">
                                        <div class="invalid-feedback">
                                            <span id="message-pembuat_jabatan"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" style="height: 100px" name="keterangan"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Foto KK</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="file1">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputNumber" class="col-sm-2 col-form-label">Upload Foto KTP</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="file2">
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    onclick="window.location.reload();">Reset</button>
                                <button type="submit" class="btn btn-success">Buat
                                    Surat</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //get date now
            var today = new Date();
            var dd = ("0" + (today.getDate())).slice(-2);
            var mm = ("0" + (today.getMonth() + 1)).slice(-2);
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            $("#input-tgl_surat").attr("value", today);


            $('#input-id').select2({
                theme: "bootstrap",
            });

            $('#input-id').on('change', function() {
                var id = this.value;

                var url = "{{ route('warga.show', ':id') }}";

                $.ajax({
                    url: url.replace(':id', id),
                    success: function(response) {


                        $('#warga_id').val(`${response.id}`);

                        //set alamat
                        var alamat_lengkap = response.alamat + ', Dusun. ' + response.dusun;
                        $('#input-alamat_lengkap').val(`${alamat_lengkap}`);

                        //set value
                        for (key in response) {
                            $('#input-' + key).val(`${response[key]}`);
                            console.log(response[key]);

                        }
                        $('#data-warga').show();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);

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
            });

            //Create Data
            $("#form_create_surat").submit(function(event) {

                /* stop form from submitting normally */
                event.preventDefault();

                var data_input = new Object();
                data_input.no_surat = $("#input-no_surat").val();
                data_input.pembuat_nama = $("#input-pembuat_nama").val();
                data_input.pembuat_jabatan = $("#input-pembuat_jabatan").val();
                data_input.pembuat_alamat = $("#input-pembuat_alamat").val();

                data_input.warga_id = $("#input-id").val();

                data_input.no_ktp = $("#input-no_ktp").val();
                data_input.nama_surat = $("#input-nama_surat").val();
                data_input.tempat_lahir = $("#input-tempat_lahir").val();
                data_input.tgl_lahir = $("#input-tgl_lahir").val();
                data_input.jenis_kelamin = $("#input-jenis_kelamin").val();
                data_input.agama = $("#input-agama").val();
                data_input.status_nikah = $("#input-status_nikah").val();
                data_input.pekerjaan = $("#input-pekerjaan").val();
                data_input.alamat_lengkap = $("#input-alamat_lengkap").val();
                data_input.tempat_surat = $("#input-tempat_surat").val();
                data_input.tgl_surat = $("#input-tgl_surat").val();
                data_input.kepala_desa = $("#input-kepala_desa").val();


                $.ajax({
                    url: "{{ route('surat.domisili.create') }}",
                    method: 'POST',
                    dataType: 'json',
                    contentType: 'application/x-www-form-urlencoded',
                    data: data_input,
                    success: function(response) {

                        //sweet alert message success
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: `Success`,
                            text: `${response.message}`,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            var url = "{{ route('surat.download', ':fileName') }}";
                            window.location.replace(url.replace(':fileName', response
                                .fileName));
                            document.getElementById("form_create_surat").reset();
                        });

                    },
                    error: function(xhr, status, error) {

                        //sweet alert message error
                        if (xhr.status == 422) {
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: `Uppss...`,
                                text: `${xhr.responseJSON.message}`,
                                showConfirmButton: true
                            })
                        } else {
                            console.log(xhr);
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: `${xhr.status}`,
                                text: `${error}`,
                                showConfirmButton: true
                            })
                        }
                    }
                })
            });
        });
    </script>
@endsection
