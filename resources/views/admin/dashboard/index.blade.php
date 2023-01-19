@extends('admin.layouts.app')

@section('content')
<!-- Content Row -->
<div class="row">

    <div class="col-xl-12 col-md-12 mb-4">
        <img src="/img/dashboard.png" style="width: 100%; height: auto;">
    </div>   
    
    <!-- Admin -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Admin</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['admin']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kasir -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kasir</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['kasir']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobil -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Mobil</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data['mobil']}}</div>
                </div> 
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-car fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kota -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Kota</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['kota']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-flag fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Promo -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Promo</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['promo']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Supir -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Supir</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['supir']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Merek Mobil -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Merek Mobil</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data['merek']}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-tag fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>
  
<div class="col-xl-4 col-md-4 mb-4">
    <div id="container">

    </div>
</div>
@endsection

@push('script')

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
      Highcharts.chart('container', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Browser market shares in May, 2020'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          accessibility: {
              point: {
                  valueSuffix: '%'
              }
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                  }
              }
          },
          series: [{
              name: 'Brands',
              colorByPoint: true,
              data: [{
                  name: 'Chrome',
                  y: 70.67,
                  sliced: true,
                  selected: true
              }, {
                  name: 'Edge',
                  y: 14.77
              },  {
                  name: 'Firefox',
                  y: 4.86
              }, {
                  name: 'Safari',
                  y: 2.63
              }, {
                  name: 'Internet Explorer',
                  y: 1.53
              },  {
                  name: 'Opera',
                  y: 1.40
              }, {
                  name: 'Sogou Explorer',
                  y: 0.84
              }, {
                  name: 'QQ',
                  y: 0.51
              }, {
                  name: 'Other',
                  y: 2.6
              }]
          }]
      });
    </script>
@endpush
