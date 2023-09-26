<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{  asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css')}}">
  <link href="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
  
       @include('layouts.navbar')
       @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <div class="row ml-1 mr-1">
          <div class="card w-100" style="background-color: #FFF3F0">
              <div class="card-header">
                <h4 style="color:#4F4789 ; font-weight:800">Total score <i class="fas fa-arrow-right"></i> 2033</h4>
              </div>
              <div class="card-body">
                @php
                $totalBooks = \App\Models\Book::count(); // Numărul total de cărți
                $totalGolds = \App\Models\Gold::count();
                $numMoney = \App\Models\Money::sum('price');
                $numCodes = \App\Models\Code::sum('hours');
            
                // Normalizați procentajele pentru fiecare categorie
                $normalizedPercentageBook = ($totalBooks / 600) * 100; // Procent 1/5  (avem 6 categorii -> sa avem una ptionala)
                $normalizedPercentageGold = ($totalGolds / 150) * 100; // Procent 1/5  (avem 6 categorii)
                $totalPercentageGolds = ($numMoney / 500000) *100;
                $totalPercentageCodes = ( $numCodes / 48000) *100;
                // Adunați procentajele normalizate
                $totalPercentage = $normalizedPercentageBook + $normalizedPercentageGold + $totalPercentageGolds + $totalPercentageCodes;
             
                @endphp
            <div class="progress mb-3" style="height: 25px;">
              <div class="progress-bar" role="progressbar" aria-valuenow="{{ $totalPercentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $totalPercentage }}%;">
                  <span>{{ number_format($totalPercentage, 2) }}%</span>
              </div>
          </div>
          
            
            </div>
            
          </div>
      </div>
      
        @yield('content')
      </div>
    
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('backend/assets/modules/jquery.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/popper.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/tooltip.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js')}}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('backend/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/chart.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{ asset('backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('backend/assets/js/page/index-0.js')}}"></script>
  
  <!-- Template JS File -->
  <script src="{{ asset('backend/assets/js/scripts.js')}}"></script>
  <script src="{{ asset('backend/assets/js/custom.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function(){
      $("#datepicker").datepicker({
         format: "yyyy",
         viewMode: "years", 
         minViewMode: "years",
         autoclose:true
      });   
    })
    
    
    </script>
    <script>
      @if ($errors->any())
         @foreach($errors->all() as $error)
           toastr.error("{{ $error }}")
          @endforeach
      @endif
    </script>
</body>
</html>
