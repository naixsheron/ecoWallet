@extends('layouts.master')
 
@section('content')

<section class="section">

  @php
  // Numărul de cărți și gold-uri din baza de date
  $numBooks = \App\Models\Book::count();
  $numGolds = \App\Models\Gold::count();
  $numMoney = \App\Models\Money::sum('price');
  $numCodes = \App\Models\Code::sum('hours');
  
  // Calculați procentajul completat pentru cărți și aur
  $completionPercentageBooks = ($numBooks / 120) * 100;
  $completionPercentageGolds = ($numGolds / 32) * 100; 
  $completionPercentageMoney =($numMoney / 100000) *100;
  $completionPercentageCode =( $numCodes / 4800) *100;

  $totalPercentageBooks = ($numBooks / 600) * 100;
  $totalPercentageGolds = ($numGolds / 150) * 100;
  $totalPercentageGolds = ($numMoney / 500000) *100;
  $totalPercentageCodes = ( $numCodes / 48000) *100;
  $totalChart= $totalPercentageBooks + $totalPercentageGolds +$totalPercentageGolds + $totalPercentageCodes;

  // Calculați procentajul total, adunând procentajele cărților și ale aurului
  $totalPercentage = $completionPercentageBooks + $completionPercentageGolds +$completionPercentageMoney +  $completionPercentageCode;
// dd($totalPercentage);
  @endphp
  
    
    <div class="row">
        
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-coins"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>GOLD</h4>
            </div>
            <div class="card-body">
              
              {{ $numGolds }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-book-reader"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>BOOK</h4>
            </div>
            <div class="card-body">
              {{ $numBooks }}
            </div>
          </div>
        </div>
      </div>
   
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-money-bill-alt"></i> 
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>MONEY</h4>
            </div>
            <div class="card-body">
              {{ $numMoney }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-code"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>CODE</h4>
            </div>
            <div class="card-body">
              {{ $numCodes }} 
            </div>
          </div>
        </div>
      </div>    
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-info">
            <i class="far fa-file-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>CRIPTO</h4>
            </div>
            <div class="card-body">
              0
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-dark">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>LAND</h4>
            </div>
            <div class="card-body">
              0 
            </div>
          </div>
        </div>
      </div>              
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
              <h4>Line Chart</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
          </div>
          
      </div>
      <div class="col-lg-6 col-md-6 col-12">
            
        <div class="card">
          <div class="card-header">
            <h4>Referral URL</h4>
          </div>
          <div class="card-body">
            <div class="mb-4">
              <div class="text-small float-right font-weight-bold text-muted">32</div>
              <div class="font-weight-bold mb-1">Gold eco</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" data-width="0%" aria-valuenow="{{ $numGolds }}" aria-valuemin="0" aria-valuemax="32" style="width: {{ $completionPercentageGolds}}%;">{{ $numGolds }} / 32</div>
              </div>                          
            </div>
         

            <div class="mb-4">
             
              <div class="text-small float-right font-weight-bold text-muted">120</div>
              <div class="font-weight-bold mb-1">Book read</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $numBooks }}" aria-valuemin="0" aria-valuemax="120" style="width: {{$completionPercentageBooks}}%;">{{ $numBooks }} / 120</div>
              </div>
            </div>

            <div class="mb-4">
              <div class="text-small float-right font-weight-bold text-muted">100000</div>
              <div class="font-weight-bold mb-1">Money bussines</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" data-width="18%" aria-valuenow="{{ $numMoney }}" aria-valuemin="0" aria-valuemax="100000"style="width: {{$completionPercentageMoney}}%;">{{ $numMoney }} / 100000</div>
              </div>
            </div>

            <div class="mb-4">
              <div class="text-small float-right font-weight-bold text-muted">480</div>
              <div class="font-weight-bold mb-1">Code home</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" data-width="6%" aria-valuenow="{{ $numCodes }}" aria-valuemin="0" aria-valuemax="4800"style="width: {{ $completionPercentageCode}}%;">{{ $numCodes }} / 4800</div>
              </div>
            </div>

            <div class="mb-4">
              <div class="text-small float-right font-weight-bold text-muted">1000</div>
              <div class="font-weight-bold mb-1">Crypto eco</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" data-width="8%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <div class="mb-4">
              <div class="text-small float-right font-weight-bold text-muted">1</div>
              <div class="font-weight-bold mb-1">Land eco</div>
              <div class="progress" data-height="3">
                <div class="progress-bar" role="progressbar" data-width="0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
@endsection
