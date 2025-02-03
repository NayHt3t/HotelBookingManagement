@extends('layouts.user_type.auth')

@section('content')

  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                    ${{number_format($incomes,2)}}
                  <span class="text-success text-sm font-weight-bolder">+{{$incomePer}}%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Booking</p>
                <h5 class="font-weight-bolder mb-0">
                 +{{$bookings}}
                  <span class="text-success text-sm font-weight-bolder">+{{$bookingPer}}%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Guests</p>
                <h5 class="font-weight-bolder mb-0">
                  +{{$guests}}
                  <span class="text-success text-sm font-weight-bolder">+{{$guestPer}}%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                <h5 class="font-weight-bolder mb-0">
                  +{{$clients}}
                  <span class="text-success text-sm font-weight-bolder">+{{$clientPer}}%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-7">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Booking overview</h6>
          <p class="text-sm">
            <!-- <i class="fa fa-arrow-up text-success"></i> -->
            <!-- <span class="font-weight-bold">4% more</span> in 2021 -->
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <div id="bookingData" data-totalBooking = "{{ implode(',', $totalBooking)}}"></div>
            <canvas id="chart-line1" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5 mb-lg-0 mb-4">
      <div class="card h-100  z-index-2">
      <div class="card-header pb-0">
          <h6>Guest overview</h6>
          <p class="text-sm">
            <!-- <i class="fa fa-arrow-up text-success"></i> -->
            <!-- <span class="font-weight-bold">4% more</span> in 2021 -->
          </p>
        </div>
        <div class="card-body p-3">
          <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
            <div class="chart" id="guestData" data-months ="{{ implode(',', $months)}}" data-totalGuest = "{{ implode(',', $totalGuest)}}">
              <canvas id="chart-bars" class="chart-canvas" height="250"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  
  <div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 ">
      <div class="card z-index-2">
      <div class="card-header pb-0">
          <h6>Room Type with booking overview</h6>
        </div>
        <div class="card-body p-3">
          <div class="border-radius-lg py-3 pe-1 mb-3">
            <div class="chart" id="roomData" data-labels ="{{ $roomType->pluck('name')->implode(',')}}"
             data-values ="{{ $roomType->pluck('bookings_count')->implode(',')}}" >
              <canvas id="pie-chart" class="chart-canvas" height="260"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card z-index-2">
        <div class="card-header pb-0">
          <h6>Income overview</h6>
          <p class="text-sm">
            <!-- <i class="fa fa-arrow-up text-success"></i> -->
            <!-- <span class="font-weight-bold">4% more</span> in 2021 -->
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <div id="incomeData" data-totalIncome = "{{ implode(',', $totalIncome)}}"></div>
            <canvas id="chart-line2" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      // Bar Chart
      let ctx = document.getElementById("chart-bars").getContext("2d");
      const guestData = document.getElementById('guestData');
      const months = guestData.getAttribute('data-months').split(',');
      const totalGuest = guestData.getAttribute('data-totalGuest').split(',').map(Number);
      let month = ctx.data;
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: months,
          datasets: [{
            label: "Guests",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: totalGuest,
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 3
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
          },
        },
      });

      // Line Chart
      let ctx2 = document.getElementById("chart-line1").getContext("2d");

      let gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      let gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      const bookingData = document.getElementById('bookingData');
      const totalBooking = bookingData.getAttribute('data-totalBooking').split(',').map(Number);
      new Chart(ctx2, {
        type: "line",
        data: {
          labels: months,
          datasets: [{
              label: "Bookings",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: totalBooking,
              maxBarThickness: 6

            }
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 12
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
      let ctx3 = document.getElementById("pie-chart").getContext("2d");
      const roomData = document.getElementById('roomData');
      const labels = roomData.getAttribute('data-labels').split(',');
      const data = roomData.getAttribute('data-values').split(',').map(Number);

      const total = data.reduce((sum, value) => sum + value, 0);
      new Chart(ctx3, {
         type : 'pie',
         data : {
          labels : labels,
          datasets : [{
            data : data,
            backgroundColor : ['#FF6384','#36A2EB', '#FFCE56','#4CAF50','#BA68C8']
          }]
         },
         options : {
          responsive: true,
          maintainAspectRatio: false,
          plugins : {
            datalabels: {
              formatter : (value,ctx3) => {
                let percentage = (value / total * 100).toFixed(1) + '%';
                return percentage
              },
              color : '#fff',
              font : {
                weight : 'bold',
                size : 18
              }
            },
            tooltip : {
              callbacks : {
                label : function(tooltipItem){
                  const value = tooltipItem.raw;
                  let percentage = (value / total * 100).toFixed(1) + '%';

                  return `${tooltipItem.label} : ${value} ${percentage}`;
                }
              }
            }
          },
          
         }, 
      });
      
      let ctx4 = document.getElementById("chart-line2").getContext("2d");
      const incomeData = document.getElementById('incomeData');
      const totalIncome = incomeData.getAttribute('data-totalIncome').split(',').map(Number);
      new Chart(ctx4, {
        type: "line",
        data: {
          labels: months,
          datasets: [{
              label: "Income",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: totalIncome,
              maxBarThickness: 6

            }
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 8
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });

    }
  </script>
@endpush

