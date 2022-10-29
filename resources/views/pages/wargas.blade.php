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
                              data-target="#modalNewWarga"> <i class="bx bx-plus"></i>&nbsp;Buat Baru</button>

                          <div id="modalNewWarga" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                  <div class="modal-content">

                                      <div class="modal-header">
                                          <h4 class="modal-title" id="myModalLabel">Tambah Penduduk baru</h4>
                                          <button type="button" class="close" data-dismiss="modal">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <form id="form_new_warga" method="post">
                                          @csrf
                                          <div class="modal-body">

                                              <div class="row">
                                                  <div class="form-group col-md-6">
                                                      <label for="input-no_ktp">No KTP/ID</label>
                                                      <input id="input-no_ktp" type="text" class="form-control"
                                                          value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-no_ktp"></small>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-6">
                                                      <label for="input-warga_negara">Kewarganegaraan</label>
                                                      <input id="input-warga_negara" type="text" class="form-control"
                                                          list="list-warga_negara" value="Indonesia">

                                                      <datalist id="list-warga_negara">
                                                          <option>Indonesia</option>
                                                      </datalist>

                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-warga_negara"></small>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-nama_lengkap">Nama Lengkap</label>
                                                  <input id="input-nama_lengkap" type="text" class="form-control"
                                                      value="">

                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-nama_lengkap"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-agama">Agama</label>
                                                  <select id="input-agama" class="form-control custom-select">
                                                      <option value="" selected disabled></option>
                                                      <option value="Islam">Islam</option>
                                                      <option value="Protestan">Protestan</option>
                                                      <option value="Katolik">Katolik</option>
                                                      <option value="Hindu">Hindu</option>
                                                      <option value="Buddha">Buddha</option>
                                                      <option value="Khonghucu">Khonghucu</option>
                                                      <option value="Penghayat Kepercayaan">Penghayat Kepercayaan</option>
                                                  </select>
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-agama"></small>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="form-group col-md-6">
                                                      <label for="input-tempat_lahir">Tempat Lahir</label>
                                                      <input id="input-tempat_lahir" type="text" class="form-control"
                                                          value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-tempat_lahir"></small>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-6">
                                                      <label for="input-tgl_lahir">Tanggal
                                                          Lahir<small class="text-small">(Tanggal/Bulan/Tahun)</small>
                                                      </label>
                                                      <input id="input-tgl_lahir" type="date" class="form-control"
                                                          value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-tgl_lahir"></small>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-jenis_kelamin">Jenis Kelamin</label>
                                                  <select id="input-jenis_kelamin" class="form-control custom-select">
                                                      <option value="" selected disabled></option>
                                                      <option value="Laki-laki">Laki-laki</option>
                                                      <option value="Perempuan">Perempuan</option>
                                                  </select>
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-jenis_kelamin"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-alamat">Alamat</label>
                                                  <input id="input-alamat" type="text" class="form-control"
                                                      value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-alamat"></small>
                                                  </div>
                                              </div>

                                              <div class="row">
                                                  <div class="form-group col-md-4">
                                                      <label for="input-dusun">Dusun</label>
                                                      <select id="input-dusun" class="form-control custom-select">
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
                                                      <input id="input-rt" type="text" class="form-control"
                                                          value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-rt"></small>
                                                      </div>
                                                  </div>

                                                  <div class="form-group col-md-4">
                                                      <label for="input-rw">RW</label>
                                                      <input id="input-rw" type="text" class="form-control"
                                                          value="">
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-rw"></small>
                                                      </div>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-golongan_darah">Golongan Darah</label>
                                                  <select id="input-golongan_darah" class="form-control custom-select">
                                                      <option value="-" selected>Tidak Diketahui</option>
                                                      <option value="O">O</option>
                                                      <option value="A">A</option>
                                                      <option value="B">B</option>
                                                      <option value="AB">AB</option>
                                                  </select>
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-golongan_darah"></small>
                                                  </div>
                                              </div>


                                              <div class="row">
                                                  <div class="form-group col-md-6">
                                                      <label for="input-pendidikan">Pendidikan</label>
                                                      <select id="input-pendidikan" class="form-control custom-select">
                                                          <option value="" selected disabled></option>
                                                          <option value="TIDAK/BELUM SEKOLAH">
                                                              TIDAK/BELUM SEKOLAH
                                                          </option>
                                                          <option value="BELUM TAMAT SD/SEDERAJAT">
                                                              BELUM TAMAT SD/SEDERAJAT
                                                          </option>
                                                          <option value="TAMAT SD/SEDERAJAT">
                                                              TAMAT SD/SEDERAJAT
                                                          </option>
                                                          <option value="SLTP/SEDERAJAT">
                                                              SLTP/SEDERAJAT
                                                          </option>
                                                          <option value="SLTA/SEDERAJAT">
                                                              SLTA/SEDERAJAT
                                                          </option>
                                                          <option value="DIPLOMA I/II">
                                                              DIPLOMA I/II
                                                          </option>
                                                          <option value="AKADEMI/DIPLOMA III/S. MUDA">
                                                              AKADEMI/DIPLOMA III/S. MUDA
                                                          </option>
                                                          <option value="DIPLOMA IV/STRATA I">
                                                              DIPLOMA IV/STRATA I
                                                          </option>
                                                          <option value="STRATA II">
                                                              STRATA II
                                                          </option>
                                                          <option value="STRATA III">
                                                              STRATA III
                                                          </option>
                                                      </select>
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-pendidikan"></small>
                                                      </div>
                                                  </div>
                                                  <div class="form-group col-md-6">
                                                      <label for="input-baca_tulis">Baca tulis?</label>
                                                      <select id="input-baca_tulis" class="form-control custom-select">
                                                          <option value="" selected disabled></option>
                                                          <option value="iya"> Iya </option>
                                                          <option value="tidak"> Tidak </option>
                                                      </select>
                                                      <div class="text-danger font-italic text-capital">
                                                          <small id="message-baca_tulis"></small>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="input-pekerjaan">Pekerjaan</label>
                                                  <input id="input-pekerjaan" type="text" class="form-control"
                                                      value="">
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-pekerjaan"></small>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="input-status_nikah">Status Perkawinan</label>
                                                  <select id="input-status_nikah" class="form-control custom-select">
                                                      <option value="" selected disabled></option>
                                                      <option value="Belum Kawin">Belum Kawin</option>
                                                      <option value="Kawin">Kawin</option>
                                                      <option value="Cerai hidup">Cerai hidup</option>
                                                      <option value="Cerai mati"> Cerai mati</option>
                                                  </select>
                                                  <div class="text-danger font-italic text-capital">
                                                      <small id="message-status_nikah"></small>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label for="input-status_warga">Status Warga</label>
                                                  <select id="input-status_warga" class="form-control custom-select">
                                                      <option value="1" selected>Aktif</option>
                                                      <option value="0">Tidak Aktif</option>
                                                  </select>
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
                          <div id="toggle" class="mb-3 border-1">
                              <p>Klik untuk menampilkan kolom:</p>
                              <a class="toggle-vis badge bg-primary" data-column="1">No KTP</a>
                              <a class="toggle-vis badge bg-primary" data-column="2">Nama Lengkap</a>
                              <a class="toggle-vis badge bg-secondary" data-column="3">Agama</a>
                              <a class="toggle-vis badge bg-secondary" data-column="4">Tempat Lahir</a>
                              <a class="toggle-vis badge bg-secondary" data-column="5">Tanggal Lahir</a>
                              <a class="toggle-vis badge bg-secondary" data-column="6">Jenis Kelamin</a>
                              <a class="toggle-vis badge bg-secondary" data-column="7">Alamat</a>
                              <a class="toggle-vis badge bg-secondary" data-column="8">Dusun</a>
                              <a class="toggle-vis badge bg-secondary" data-column="9">RT</a>
                              <a class="toggle-vis badge bg-secondary" data-column="10">RW</a>
                              <a class="toggle-vis badge bg-secondary" data-column="11">Golongan Darah</a>
                              <a class="toggle-vis badge bg-secondary" data-column="12">Warga Negara</a>
                              <a class="toggle-vis badge bg-secondary" data-column="13">Pendidikan</a>
                              <a class="toggle-vis badge bg-secondary" data-column="14">Pekerjaan</a>
                              <a class="toggle-vis badge bg-secondary" data-column="15">Perkawinan</a>
                              <a class="toggle-vis badge bg-secondary" data-column="16">Status Dalam Keluarga</a>
                              <a class="toggle-vis badge bg-primary" data-column="17">No KK</a>
                              <a class="toggle-vis badge bg-primary" data-column="18">Status Warga</a>
                          </div>
                          <div class="table-responsive">
                              <table id="tableWarga" class="display .datatable table table-hover table-bordered"
                                  style="width:100%">
                                  <thead>
                                      <tr>
                                          <th width="2%">No</th>
                                          <th>No KTP</th>
                                          <th>Nama Lengkap</th>
                                          <th>Agama</th>
                                          <th>Tempat Lahir</th>
                                          <th>Tanggal Lahir</th>
                                          <th>Jenis Kelamin</th>
                                          <th>Alamat</th>
                                          <th>Dusun</th>
                                          <th>RT</th>
                                          <th>RW</th>
                                          <th>Golongan Darah</th>
                                          <th>Warga Negara</th>
                                          <th>Pendidikan</th>
                                          <th>Pekerjaan</th>
                                          <th>Perkawinan</th>
                                          <th>Status Dalam Keluarga</th>
                                          <th>No KK</th>
                                          <th>Status Warga</th>
                                          <th style="text-align: right">Aksi</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <!-- /page content -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="editLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editLabel">Edit data Penduduk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="form_edit_warga" method="post">
                      @csrf
                      <div class="modal-body">
                          <input id="warga_id" type="hidden">
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="input-edit-no_ktp">No KTP/ID</label>
                                  <input id="input-edit-no_ktp" type="text" class="form-control" value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-no_ktp"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="input-edit-warga_negara">Kewarganegaraan</label>
                                  <input id="input-edit-warga_negara" type="text" class="form-control"
                                      list="list-warga_negara" value="">

                                  <datalist id="list-warga_negara">
                                      <option>Indonesia</option>
                                  </datalist>

                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-warga_negara"></small>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-nama_lengkap">Nama Lengkap</label>
                              <input id="input-edit-nama_lengkap" type="text" class="form-control" value="">

                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-nama_lengkap"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-agama">Agama</label>
                              <select id="input-edit-agama" class="form-control custom-select">
                                  <option value="Islam">Islam</option>
                                  <option value="Protestan">Protestan</option>
                                  <option value="Katolik">Katolik</option>
                                  <option value="Hindu">Hindu</option>
                                  <option value="Buddha">Buddha</option>
                                  <option value="Khonghucu">Khonghucu</option>
                                  <option value="Penghayat Kepercayaan">Penghayat Kepercayaan</option>
                              </select>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-agama"></small>
                              </div>
                          </div>
                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="input-edit-tempat_lahir">Tempat Lahir</label>
                                  <input id="input-edit-tempat_lahir" type="text" class="form-control"
                                      value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-tempat_lahir"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="input-edit-tgl_lahir">Tanggal
                                      Lahir<small class="text-small">(Tanggal/Bulan/Tahun)</small>
                                  </label>
                                  <input id="input-edit-tgl_lahir" type="date" class="form-control" value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-tgl_lahir"></small>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-jenis_kelamin">Jenis Kelamin</label>
                              <select id="input-edit-jenis_kelamin" class="form-control custom-select">
                                  <option value="Laki-laki">Laki-laki</option>
                                  <option value="Perempuan">Perempuan</option>
                              </select>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-jenis_kelamin"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-alamat">Alamat</label>
                              <input id="input-edit-alamat" type="text" class="form-control" value="">
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-alamat"></small>
                              </div>
                          </div>

                          <div class="row">
                              <div class="form-group col-md-4">
                                  <label for="input-edit-dusun">Dusun</label>
                                  <select id="input-edit-dusun" class="form-control custom-select">
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
                                  <input id="input-edit-rt" type="text" class="form-control" value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-rt"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-4">
                                  <label for="input-edit-rw">RW</label>
                                  <input id="input-edit-rw" type="text" class="form-control" value="">
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-rw"></small>
                                  </div>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-golongan_darah">Golongan Darah</label>
                              <select id="input-edit-golongan_darah" class="form-control custom-select">
                                  <option value="-" selected>Tidak Diketahui</option>
                                  <option value="O">O</option>
                                  <option value="A">A</option>
                                  <option value="B">B</option>
                                  <option value="AB">AB</option>
                              </select>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-golongan_darah"></small>
                              </div>
                          </div>


                          <div class="row">
                              <div class="form-group col-md-6">
                                  <label for="input-edit-pendidikan">Pendidikan</label>
                                  <select id="input-edit-pendidikan" class="form-control custom-select">
                                      <option value="TIDAK/BELUM SEKOLAH">
                                          TIDAK/BELUM SEKOLAH
                                      </option>
                                      <option value="BELUM TAMAT SD/SEDERAJAT">
                                          BELUM TAMAT SD/SEDERAJAT
                                      </option>
                                      <option value="TAMAT SD/SEDERAJAT">
                                          TAMAT SD/SEDERAJAT
                                      </option>
                                      <option value="SLTP/SEDERAJAT">
                                          SLTP/SEDERAJAT
                                      </option>
                                      <option value="SLTA/SEDERAJAT">
                                          SLTA/SEDERAJAT
                                      </option>
                                      <option value="DIPLOMA I/II">
                                          DIPLOMA I/II
                                      </option>
                                      <option value="AKADEMI/DIPLOMA III/S. MUDA">
                                          AKADEMI/DIPLOMA III/S. MUDA
                                      </option>
                                      <option value="DIPLOMA IV/STRATA I">
                                          DIPLOMA IV/STRATA I
                                      </option>
                                      <option value="STRATA II">
                                          STRATA II
                                      </option>
                                      <option value="STRATA III">
                                          STRATA III
                                      </option>
                                  </select>
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-pendidikan"></small>
                                  </div>
                              </div>

                              <div class="form-group col-md-6">
                                  <label for="input-edit-baca_tulis">Baca tulis?</label>
                                  <select id="input-edit-baca_tulis" class="form-control custom-select">
                                      <option value="" selected disabled></option>
                                      <option value="iya"> Iya </option>
                                      <option value="tidak"> Tidak </option>
                                  </select>
                                  <div class="text-danger font-italic text-capital">
                                      <small id="message-edit-baca_tulis"></small>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="input-edit-pekerjaan">Pekerjaan</label>
                              <input id="input-edit-pekerjaan" type="text" class="form-control" value="">
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-pekerjaan"></small>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="input-edit-status_nikah">Status Perkawinan</label>
                              <select id="input-edit-status_nikah" class="form-control custom-select">
                                  <option value="Belum Kawin">Belum Kawin</option>
                                  <option value="Kawin">Kawin</option>
                                  <option value="Cerai hidup">Cerai hidup</option>
                                  <option value="Cerai mati"> Cerai mati</option>
                              </select>
                              <div class="text-danger font-italic text-capital">
                                  <small id="message-edit-status_nikah"></small>
                              </div>
                          </div>

                          <div class="form-group">
                              <label for="input-edit-status_warga">Status Warga</label>
                              <select id="input-edit-status_warga" class="form-control custom-select">
                                  <option value="1">Aktif</option>
                                  <option value="0">Tidak Aktif</option>
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


              //search by column
              $('#tableWarga thead tr').clone(true).appendTo('#tableWarga thead');
              $('#tableWarga thead tr:eq(1) th').each(function(i) {
                  var title = $(this).text();
                  var index = $(this).index();
                  if (index === 0 || index === 19) {
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

              var desa = 'Matanga';
              var table = $('#tableWarga').DataTable({
                  processing: true,
                  serverSide: true,
                  orderCellsTop: true,
                  fixedHeader: true,
                  ajax: "{{ url('warga') }}",
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
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                                      18
                                  ]
                              },
                          },
                          {
                              extend: "pdfHtml5",
                              text: '<i class="bi bi-file-earmark-pdf-fill"></i> PDF',
                              titleAttr: 'PDF',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                                      18
                                  ]
                              },
                          },
                          {
                              extend: 'print',
                              text: ' <i class="bi bi-printer-fill"></i> Print',
                              titleAttr: 'Print',
                              exportOptions: {
                                  columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17,
                                      18
                                  ]
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
                          targets: [19]
                      },
                      {
                          visible: false,
                          target: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16],
                      }
                  ],
                  columns: [{
                          render: function(data, type, row, meta) {
                              return `<b>${meta.row + meta.settings._iDisplayStart + 1}</b> `;
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
                          data: "agama",
                          name: "agama",
                      },
                      {
                          data: "tempat_lahir",
                          name: "tempat_lahir",
                      },
                      {
                          render: function(data, type, row, meta) {
                              return moment(row['tgl_lahir']).format('YYYY-MM-DD');
                          }
                      },
                      {
                          data: "jenis_kelamin",
                          name: "jenis_kelamin",
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
                          data: "golongan_darah",
                          name: "golongan_darah",
                      },
                      {
                          data: "warga_negara",
                          name: "warga_negara",
                      },
                      {
                          data: "pendidikan",
                          name: "pendidikan",
                      },
                      {
                          data: "pekerjaan",
                          name: "pekerjaan",
                      },
                      {
                          data: "status_nikah",
                          name: "status_nikah",
                      },
                      {
                          data: "status_anggota",
                          name: "status_anggota",
                      },
                      {
                          data: "no_kk",
                          name: "no_kk",
                      },
                      {
                          data: "status_warga",
                          name: "status_warga",
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
                            <div class="float-right btn-group" role="group">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editModalUser('${row["id"]}')">
                                    Ubah
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteModalAccount('${row["id"]}', '${row["nama_lengkap"]}')">
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
          });


          //Create Data
          $("#form_new_warga").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.no_ktp = $("#input-no_ktp").val();
              data_input.nama_lengkap = $("#input-nama_lengkap").val();
              data_input.agama = $("#input-agama").val();
              data_input.tempat_lahir = $("#input-tempat_lahir").val();
              data_input.tgl_lahir = $("#input-tgl_lahir").val();
              data_input.jenis_kelamin = $("#input-jenis_kelamin").val();
              data_input.alamat = $("#input-alamat").val();
              data_input.dusun = $("#input-dusun").val();
              data_input.rt = $("#input-rt").val();
              data_input.rw = $("#input-rw").val();
              data_input.golongan_darah = $("#input-golongan_darah").val();
              data_input.warga_negara = $("#input-warga_negara").val();
              data_input.pendidikan = $("#input-pendidikan").val();
              data_input.baca_tulis = $("#input-baca_tulis").val();
              data_input.pekerjaan = $("#input-pekerjaan").val();
              data_input.status_nikah = $("#input-status_nikah").val();
              data_input.status_warga = $("#input-status_warga").val();

              //console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#message-${obj}`).html('');
              }

              $.ajax({
                  url: "{{ route('warga.create') }}",
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      // console.log(response);

                      //close modal
                      $('#modalNewWarga .close').click();
                      $("#form_new_warga").trigger('reset');

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
                      $('#tableWarga').DataTable().ajax.reload();
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

              $("#form_edit_warga").find('.has-error').removeClass("has-error");
              $("#form_edit_warga").removeClass("is-invalid");

              var url = "{{ route('warga.show', ':id') }}";
              $.ajax({
                  url: url.replace(':id', id),
                  success: function(response) {
                      console.log(response[0]);
                      $('#warga_id').val(`${response.id}`);

                      //set value
                      for (key in response) {
                          $('#input-edit-' + key).val(`${response[key]}`);
                          $(`#message-edit-${key}`).html('');
                      }

                      //select option set value
                      document.querySelector('#input-edit-dusun')
                          .options[response.dusun.selectedIndex];
                      document.querySelector('#input-edit-agama')
                          .options[response.agama.selectedIndex];
                      document.querySelector('#input-edit-jenis_kelamin')
                          .options[response.jenis_kelamin.selectedIndex];
                      document.querySelector('#input-edit-golongan_darah')
                          .options[response.golongan_darah.selectedIndex];
                      document.querySelector('#input-edit-pendidikan')
                          .options[response.pendidikan.selectedIndex];
                      document.querySelector('#input-edit-status_nikah')
                          .options[response.status_nikah.selectedIndex];
                      document.querySelector('#input-edit-baca_tulis')
                          .options[response.baca_tulis.selectedIndex];

                      if (response.status_warga == "1") {
                          document.querySelector('#input-edit-status_warga').options[0].selected = true;
                      } else {
                          document.querySelector('#input-edit-status_warga').options[1].selected = true;
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
          $("#form_edit_warga").submit(function(event) {

              /* stop form from submitting normally */
              event.preventDefault();

              var data_input = new Object();
              data_input.id = $("#warga_id").val()
              data_input.no_ktp = $("#input-edit-no_ktp").val();
              data_input.nama_lengkap = $("#input-edit-nama_lengkap").val();
              data_input.agama = $("#input-edit-agama").val();
              data_input.tempat_lahir = $("#input-edit-tempat_lahir").val();
              data_input.tgl_lahir = $("#input-edit-tgl_lahir").val();
              data_input.jenis_kelamin = $("#input-edit-jenis_kelamin").val();
              data_input.alamat = $("#input-edit-alamat").val();
              data_input.dusun = $("#input-edit-dusun").val();
              data_input.rt = $("#input-edit-rt").val();
              data_input.rw = $("#input-edit-rw").val();
              data_input.golongan_darah = $("#input-edit-golongan_darah").val();
              data_input.warga_negara = $("#input-edit-warga_negara").val();
              data_input.pendidikan = $("#input-edit-pendidikan").val();
              data_input.baca_tulis = $("#input-edit-baca_tulis").val();
              data_input.pekerjaan = $("#input-edit-pekerjaan").val();
              data_input.status_nikah = $("#input-edit-status_nikah").val();
              data_input.status_warga = $("#input-edit-status_warga").val();

              //console.log(data_input);

              //reset validation
              for (obj in data_input) {
                  $(`#message-edit-${obj}`).html('');
              }

              $.ajax({
                  url: "{{ route('warga.update') }}",
                  method: 'POST',
                  dataType: 'json',
                  contentType: 'application/x-www-form-urlencoded',
                  data: data_input,
                  success: function(response) {
                      //console.log(response);

                      //close modal
                      $('#modalEdit .close').click();
                      $("#form_edit_warga").trigger('reset');

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
                      $('#tableWarga').DataTable().ajax.reload();
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
          deleteModalAccount = (id, name) => {

              //console.log(id);

              Swal.fire({
                  title: 'Hapus data',
                  text: `Yakin ingin menghapus data ${name}?`,
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, hapus data!',
                  cancelButtonText: 'Batalkan'
              }).then((isDelete) => {
                  if (isDelete.isConfirmed) {

                      $.ajax({
                          url: "warga/delete/" + id,
                          method: 'DELETE',
                          contentType: 'application/x-www-form-urlencoded',
                          success: function(response) {

                              Swal.fire(
                                  'Deleted!',
                                  `${response.message}`,
                                  'success'
                              )

                              //reload only datatable
                              $('#tableWarga').DataTable().ajax.reload();
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
