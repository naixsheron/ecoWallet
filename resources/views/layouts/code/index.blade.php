@extends('layouts.master')

@section('content')

<section class="section">

  

    <div class="row">
        <div class="col-12 col-md-5 col-lg-5">
            <?php
            // Calculați suma prețurilor din baza de date
            $totalPrice = \App\Models\Code::sum('hours');
          
        
            // Calculați procentajul completării în funcție de suma prețurilor
            $completionPercentage = ($totalPrice / 4800) * 100;
            ?>

            <div class="card-header" style= "border:5px solid rgb(212, 207, 207) ; border-top-left-radius: 10%; border-top-right-radius: 10%; box-shadow:5px 10px 10px rgb(126, 125, 125)" >
                <h4>Code Score</h4>
                <div class="progress mt-5">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{  $totalPrice }}" aria-valuemin="0" aria-valuemax="32" style="width: {{ $completionPercentage}}%;">{{ $totalPrice }} / 4800</div>
                </div>
            </div>
            <div class="card" style= "padding-bottom:10px; border:5px solid rgb(212, 207, 207) ; border-bottom-left-radius: 10%;  border-bottom-right-radius: 10%; box-shadow:5px 10px 10px rgb(126, 125, 125)">
                <div class="card-header">
                    <h4 style="color:#4F4789 ; font-weight:800">Code Chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="myLineChart"></canvas>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                let months = @json($months); // Converțiți array-ul PHP într-un obiect JavaScript JSON
                let monthCount = @json($monthCount); // Converțiți array-ul PHP într-un obiect JavaScript JSON

                let ctx = document.getElementById('myLineChart').getContext('2d');
                let myLineChart = new Chart(ctx, {
                     type: 'line', // Setăm tipul de grafic la 'line'
                     data: {
                     labels: months, // Lunile vor fi etichetele pe axa X
                     datasets: [{
                        label: 'Number of Code',
                            data: monthCount, // Numărul de gold-uri va fi reprezentat pe axa Y
                             borderColor: '#6777ef', // Culoarea liniei graficului
                              borderWidth: 4, // Grosimea liniei graficului
                              fill: false // Fără umplere sub linie
                               }]
                               },
                         options: {
                        scales: {
                           y: {
                             beginAtZero: true // Axa Y începe de la zero
                              }
                              }
                             }
                         });

            </script>

        </div>
        <div class="col-12 col-md-7 col-lg-7">
            <div class="card" style="border:8px solid #a8a09e; border-bottom-left-radius: 8%;  border-bottom-right-radius: 8%; box-shadow: 15px 10px 25px 15px #459910">
                <div class="card-header d-flex justify-content-between" style="background-color: #cecece;" >
                    <h4 style="color:#ffffff ; font-weight:800">All Code </h4>
                    <div class="text-right">
                        <a href="{{ route('code.create') }}" class="btn btn-primary" id="modal-2">+ New Code</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" style="border: 10px solid #cecece; width: 100%; border-collapse: collapse;">
                            <tr style="background-color: #cecece; color: #3B0D11;">
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">#</th>
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">Image</th>
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">Titlu</th>
                             
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">Created At</th>
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">Hours</th>
                                <th style="border: 5px solid #cecece; padding: 12px; font-size: 15px; font-weight: 900; color: #211613;">Details</th>
                            </tr>
                            @foreach ($codes  as $index => $code)
                            <tr style="background-color: #fff;">
                                <td  style="border: 5px solid #cecece;  color: #3B0D11; font-size: 20px; font-weight: 600; ">{{ $index + 1 }}</td>
                                <td style="border: 5px solid #cecece; "><img src="{{  $code->banner }}" style="width: 40px" alt="Imagine aur"></td>
                                <td style="border: 5px solid #cecece;  color: #3B0D11; font-size: 14px; font-weight: 600;">{{  $code->title }}</td>
                               
                                <td style="border: 5px solid #cecece;  color: #3B0D11; font-size: 14px; font-weight: 600;">{{  $code->created_at }}</td>
                                <td style="border: 5px solid #cecece; color: #3B0D11; font-size: 14px; font-weight: 600;">{{  $code->hours }}</td>
                                <td style="border: 5px solid #cecece;  color: #3B0D11; font-size: 14px; font-weight: 600;">{{  $code->details }}</td>
                    
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            @if ($codes->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" href="#"><i class="fas fa-chevron-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $codes->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                </li>
                            @endif

                            @foreach ($codes->getUrlRange(1, $codes->lastPage()) as $page => $url)
                                @if ($page == $codes->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($codes->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $codes->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link" href="#"><i class="fas fa-chevron-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
