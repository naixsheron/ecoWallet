@extends('layouts.master')
 
@section('content')

<section class="section" style="max-width: 1850px">

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
  
    
    <div class="row ml-2 mr-2" style="margin-top:-17px">
        
      <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1" >
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
    
    <div class="row ml-3 mr-3">
      <div class="col-lg-3 col-md-12 col-12 col-sm-12">
        <div class="card" style="margin-top:-8px; border:5px solid #4F4789 ; border-radius:25% ; box-shadow: 3px 5px 5px 5px #1657ac ">
          <div class="card-header">
            <h4 style="color:#4F4789 ; font-weight:800 ; margin-left:30px ">My Chart</h4>
          </div>
          <div class="card-body">
            <canvas id="myChart4"></canvas>
          </div>
        </div>
      </div>
      {{-- <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
              <h4>Line Chart</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
            
          </div>
          
      </div> --}}
      <div class="col-lg-4 col-md-4 col-12 ">
            
        <div class="card" style="margin-top:-8px; border:5px solid #106706 ; border-radius:5% ; box-shadow: 3px 5px 5px 5px #2ec011 ">
          <div class="card-header">
            <h4 style="color:#4F4789 ; font-weight:800" >Inline Status</h4>
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
      <div class="col-12 col-sm-5 col-lg-5">
        <div class="card" style="margin-top:-8px; border:5px solid #915408 ; border-radius:5% ; box-shadow: 3px 5px 5px 5px #ee6503 ">
          <div class="card-header">
            <h4 style="color:#4F4789 ; font-weight:800">Motivating</h4>
          </div>
          <div class="card-body">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" style="max-width:535px" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="img/news/img01.jpg" style="border-radius:15%" alt="First slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/news/img07.jpg" style="border-radius:15%" alt="Second slide">
                </div>
                <div class="carousel-item">
                  <img class="d-block w-100" src="img/news/img08.jpg" style="border-radius:15%" alt="Third slide">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
    </div>
    
    
    
    
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Obțineți elementul canvas
    let ctx4 = document.getElementById('myChart4').getContext('2d');
    
    // Definiți datele pentru pie chart
    let pieChartData = {
        labels: ['Books', 'Gold', 'Money', 'Code'],
        datasets: [{
            data: [{{ $completionPercentageBooks }}, {{ $completionPercentageGolds }}, {{$completionPercentageMoney }}, {{ $completionPercentageCode }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Inițializați un obiect Chart pentru pie chart
    let pieChart = new Chart(ctx4, {
        type: 'pie', // Tipul graficului
        data: pieChartData, // Datele
    });
</script>

    {{-- <script>
      // Obțineți elementul canvas
      let ctx = document.getElementById('myChart').getContext('2d');
    
      // Configurați opțiunile graficului
      let options = {
        scales: {
          y: {
            beginAtZero: true // Axele încep de la zero
          }
        }
      };
    
      // Faceți solicitarea către API-ul de aur
      let myHeaders = new Headers();
      myHeaders.append("x-access-token", "goldapi-2k6hhslrlmryvnm0-io");
      myHeaders.append("Content-Type", "application/json");
    
      let requestOptions = {
        method: 'GET',
        headers: myHeaders,
        redirect: 'follow'
      };
    
      fetch("https://www.goldapi.io/api/XAU/USD", requestOptions)
        .then(response => response.json()) // Răspunsul este în format JSON, deci îl parsăm
        .then(data => {
          // Extrageți prețul aurului din obiectul de răspuns
          const goldPrice = data.price;
    
          // Definiți datele pentru grafic folosind prețul aurului
          let chartData = {
            labels: ['Gold Price'],
            datasets: [{
              label: 'Gold Price',
              data: [goldPrice],
              backgroundColor: 'rgba(255, 215, 0, 0.2)', // Culorile pentru fundal
              borderColor: 'rgba(255, 215, 0, 1)', // Culorile pentru linie
              borderWidth: 2, // Grosimea liniei
            }]
          };
    
          // Inițializați un obiect Chart pentru graficul cu prețul aurului
          let goldChart = new Chart(ctx, {
            type: 'line', // Tipul graficului
            data: chartData, // Datele
            options: options // Opțiunile
          });
        })
        .catch(error => console.log('error', error));
    </script> --}}
    
    
    
  </section> 
@endsection
