  @extends('layouts.app')
  @section('content')
      <div class="pagetitle">
          <h3 id="time">-</h3>
          <h1>Halo {{ auth()->user()->username }}, Selamat datang 👋</h1>
      </div><!-- End Page Title -->

      <section class="section dashboard">

          {{-- <div class="card">
              <!-- Slides with captions -->
              <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
                  <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                          aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                          aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                          aria-label="Slide 3"></button>
                  </div>
                  <div class="carousel-inner" style="height: 300px;">
                      <div class="carousel-item active">
                          <img src="https://source.unsplash.com/random/1000x300" class="d-block w-100" alt="...">
                          <div class="carousel-caption d-none d-md-block">
                              <h5>First slide label</h5>
                              <p>Some representative placeholder content for the first slide.</p>
                          </div>
                      </div>
                      <div class="carousel-item">
                          <img src="https://source.unsplash.com/random/1000x300" class="d-block w-100" alt="...">
                          <div class="carousel-caption d-none d-md-block">
                              <h5>Second slide label</h5>
                              <p>Some representative placeholder content for the second slide.</p>
                          </div>
                      </div>
                      <div class="carousel-item">
                          <img src="https://source.unsplash.com/random/1000x300" class="d-block w-100" alt="...">
                          <div class="carousel-caption d-none d-md-block">
                              <h5>Third slide label</h5>
                              <p>Some representative placeholder content for the third slide.</p>
                          </div>
                      </div>
                  </div>

                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                      data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                      data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                  </button>

              </div><!-- End Slides with captions -->

          </div> --}}

          <div class="row">

              <div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="card info-card sales-card">

                      <div class="filter">
                          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                  <h6>Filter</h6>
                              </li>
                              <li><a class="dropdown-item" onclick="getBy('penduduk','month')">Bulan ini</a>
                              </li>
                              <li><a class="dropdown-item" onclick="getBy('penduduk','year')">Tahun ini</a></li>
                          </ul>
                      </div>

                      <div class="card-body">

                          <h5 class="card-title">Penduduk <span id="byDate-penduduk">| Bulan ini</span></h5>

                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-people"></i>
                              </div>
                              <div class="ps-3 align-center">

                              </div>
                              <div class="ps-3">
                                  <div id="count-penduduk">
                                      -
                                  </div>
                                  <span class=" small pt-1 fw-bold">
                                      <a class="text-decoration-none text-success" href="{{ route('wargas') }}">
                                          Lihat semua <i class="bi bi-arrow-right-short"></i>
                                      </a>
                                  </span>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="card info-card revenue-card">

                      <div class="filter">
                          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                  <h6>Filter</h6>
                              </li>
                              <li><a class="dropdown-item" onclick="getBy('keluarga','month')">Bulan ini</a></li>
                              <li><a class="dropdown-item" onclick="getBy('keluarga','year')">Tahun ini</a></li>
                          </ul>
                      </div>

                      <div class="card-body">
                          <h5 class="card-title">Keluarga <span id="byDate-keluarga">| Bulan ini</span></h5>

                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-people"></i>
                              </div>
                              <div class="ps-3">
                                  <div id="count-keluarga">
                                      -
                                  </div>
                                  <span class=" small pt-1 fw-bold">
                                      <a class="text-decoration-none text-success" href="{{ route('keluargas') }}">
                                          Lihat semua <i class="bi bi-arrow-right-short"></i>
                                      </a>
                                  </span>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="card info-card customers-card">

                      <div class="filter">
                          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                  <h6>Filter</h6>
                              </li>
                              <li><a class="dropdown-item" onclick="getBy('surat','month')">Bulan ini</a></li>
                              <li><a class="dropdown-item" onclick="getBy('surat','year')">Tahun ini</a></li>
                          </ul>
                      </div>

                      <div class="card-body">
                          <h5 class="card-title">Surat <span id="byDate-surat">| Bulan ini</span></h5>

                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="bi bi-files"></i>
                              </div>
                              <div class="ps-3">
                                  <div id="count-surat">
                                      -
                                  </div>
                                  <span class=" small pt-1 fw-bold">
                                      <a class="text-decoration-none text-success" href="{{ route('surats') }}">
                                          Lihat semua <i class="bi bi-arrow-right-short"></i>
                                      </a>
                                  </span>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <div class="col-lg-3 col-md-6 col-sm-12">
                  <div class="card info-card mutasi-card">

                      <div class="filter">
                          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                              <li class="dropdown-header text-start">
                                  <h6>Filter</h6>
                              </li>
                              <li><a class="dropdown-item" onclick="getBy('mutasi','month')">Bulan ini</a></li>
                              <li><a class="dropdown-item" onclick="getBy('mutasi','year')">Tahun ini</a></li>
                          </ul>
                      </div>

                      <div class="card-body">
                          <h5 class="card-title">Mutasi <span id="byDate-mutasi">| Bulan ini</span></h5>

                          <div class="d-flex align-items-center">
                              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                  <i class="ri ri-arrow-left-right-fill"></i>
                              </div>
                              <div class="ps-3">
                                  <div id="count-mutasi">
                                      -
                                  </div>
                                  <span class=" small pt-1 fw-bold">
                                      <a class="text-decoration-none text-success" href="{{ route('mutasi') }}">
                                          Lihat semua <i class="bi bi-arrow-right-short"></i>
                                      </a>
                                  </span>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Penduduk</h5>

                          <!-- Pie Chart -->
                          <div id="loading-pieGender"></div>
                          <div id="pieChart"></div>

                          <script>
                              document.addEventListener("DOMContentLoaded", () => {
                                  loading('show', 'pieGender');

                                  $.ajax({
                                      url: "{{ route('home.getCountGender') }}",
                                      success: function(response) {

                                          var options2 = {
                                              series: response.series,
                                              chart: {
                                                  height: 350,
                                                  type: 'pie',
                                                  toolbar: {
                                                      show: true
                                                  }
                                              },
                                              labels: response.labels
                                          }

                                          var chart2 = new ApexCharts(document.querySelector("#pieChart"), options2);
                                          chart2.render();
                                          loading('hide', 'pieGender');
                                      }
                                  })

                              });
                          </script>
                          <!-- End Pie Chart -->

                      </div>
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="card">
                      <div class="card-body">
                          <h5 class="card-title">Mutasi</h5>

                          <!-- Column Chart -->
                          <div id="columnChart"></div>

                          <script>
                              document.addEventListener("DOMContentLoaded", () => {

                                  loading('show', 'columnChart');

                                  $.ajax({
                                      url: "{{ route('home.getCountMutasi') }}",
                                      success: function(response) {
                                          var options = {
                                              series: [{
                                                  name: 'Masuk',
                                                  data: response.masuk
                                              }, {
                                                  name: 'Keluar',
                                                  data: response.keluar
                                              }],
                                              chart: {
                                                  type: 'bar',
                                                  height: 336
                                              },
                                              plotOptions: {
                                                  bar: {
                                                      horizontal: false,
                                                      columnWidth: '55%',
                                                      endingShape: 'rounded'
                                                  },
                                              },
                                              dataLabels: {
                                                  enabled: false
                                              },
                                              stroke: {
                                                  show: true,
                                                  width: 2,
                                                  colors: ['transparent']
                                              },
                                              xaxis: {
                                                  categories: response.categories,
                                              },
                                              yaxis: {
                                                  title: {
                                                      text: 'Jumlah'
                                                  }
                                              },
                                              fill: {
                                                  opacity: 1
                                              },
                                              tooltip: {
                                                  y: {
                                                      formatter: function(val) {
                                                          return val + " data mutasi"
                                                      }
                                                  }
                                              }
                                          }

                                          var chart = new ApexCharts(document.querySelector("#columnChart"), options);
                                          chart.render();

                                          loading('hide', 'columnChart');
                                      }
                                  });

                              });
                          </script>
                          <!-- End Column Chart -->

                      </div>
                  </div>
              </div>



          </div><!-- End Left side columns -->
      </section>

      <script>
          $(document).ready(function() {
              // realtime clock
              var timeDisplay = document.getElementById("time");

              function refreshTime() {
                  var dateString = new Date().toLocaleString("en-US", {
                      timeZone: "Asia/Jakarta"
                  });
                  var formattedString = dateString.replace(", ", " - ");

                  moment.locale("id");
                  const format1 = "dddd, D MMM YYYY | HH:mm:ss";
                  const myDate = moment(dateString).format(format1);

                  timeDisplay.innerHTML = myDate;
              }

              setInterval(refreshTime, 1000);

              //   -------------------
              getBy('penduduk', 'month');
              getBy('keluarga', 'month');
              getBy('surat', 'month');
              getBy('mutasi', 'month');

          });

          //set default data

          getBy = (byData, byDate) => {

              $(`#count-${byData}`).html(` 
                <div class="spinner-border spinner-border-sm text-dark" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                `);

              var url = '{{ route('home.getCountData', ':by') }}'
              $.ajax({
                  url: url.replace(':by', byDate),
                  success: function(response) {
                      if (byData == 'penduduk') {
                          $(`#count-${byData}`).html(`<h6>${response.penduduk}</h6>`);
                      }

                      if (byData == 'keluarga') {
                          $(`#count-${byData}`).html(`<h6>${response.keluarga}</h6>`);
                      }

                      if (byData == 'surat') {
                          $(`#count-${byData}`).html(`<h6>${response.surat}</h6>`);
                      }

                      if (byData == 'mutasi') {
                          $(`#count-${byData}`).html(`<h6>${response.mutasi}</h6>`);
                      }

                      setBy(byData, byDate);
                  }
              });
          }

          function setBy(byData, byDate) {
              if (byDate == 'month') {
                  $(`#byDate-${byData}`).html('| Bulan ini');
              }

              if (byDate == 'year') {
                  $(`#byDate-${byData}`).html('| Tahun ini');
              }


          }

          function loading(show, chart) {
              console.log(show);
              if (show == 'show') {
                  $(`#loading-${chart}`).html(`
                    <div class="d-flex align-items-center justify-content-center" style="height:350px ">
                        <div class="spinner-border spinner-border-lg text-primary" style="margin-top:-100px" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                 `);
              } else {
                  $(`#loading-${chart}`).html('');
              }
          }
      </script>
  @endsection
