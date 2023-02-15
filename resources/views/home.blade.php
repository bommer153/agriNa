@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
  <div class="panel-header panel-header-lg">
    <canvas id="bigDashboardChart"></canvas>
  </div>
  <div class="content">
    <div class="row">
      
      
      <div class="col-lg-6 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Best Selling Product</h5>
            <h4 class="card-title"></h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="bestSeller"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
             
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Best Driver</h5>
            <h4 class="card-title"></h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="bestDriver"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
             
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-12">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Most Barangay Buys</h5>
            <h4 class="card-title"></h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="bestBarangay"></canvas>
            </div>
          </div>
          <div class="card-footer">
            <div class="stats">
             
            </div>
          </div>
        </div>
      </div>


    </div>
    
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
       demo.initDashboardPageCharts("{{ $sale[0] }}","{{ $sale[1] }}","{{ $sale[2] }}","{{ $sale[3] }}","{{ $sale[4] }}","{{ $sale[5] }}","{{ $sale[6] }}","{{ $sale[7] }}","{{ $sale[8] }}","{{ $sale[9] }}","{{ $sale[10] }}","{{ $sale[11] }}");
       
     

    });
    $(document).ready(function() {
      var passedArray = {!! json_encode($bestSeller) !!}

      bestSeller(passedArray);
   });

   $(document).ready(function() {
      var brgyData = {!! json_encode($bestBarangay) !!}
      var brgyName = {!! json_encode($brgyName) !!}

      bestBarangay(brgyData,brgyName);
   });

   $(document).ready(function() {
      var bestDriverA = {!! json_encode($bestDriverA) !!}
      var bestDriverLabel = {!! json_encode($bestDriverLabel) !!}

      bestDriver(bestDriverA,bestDriverLabel);
   });


  </script>
@endpush