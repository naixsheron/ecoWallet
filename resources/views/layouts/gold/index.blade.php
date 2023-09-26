@extends('layouts.master')

@section('content')

<section class="section">

    <div class="text-right">
        <a href="{{ route('gold.create') }}" class="btn btn-primary" id="modal-2">+ New Gold</a>
    </div>

    <div class="row">
        <div class="col-12 col-md-5 col-lg-5">
            <?php
            // Numărați gold-urile din baza de date
            $numGolds = \App\Models\Gold::count();

            // Calculați procentajul completat
            $completionPercentage = ($numGolds / 32) * 100;
            ?>

            <div class="card-header">
                <h4>Gold Score</h4>
                <div class="progress mt-5">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $numGolds }}" aria-valuemin="0" aria-valuemax="32" style="width: {{ $completionPercentage}}%;">{{ $numGolds }} / 32</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 style="color:#4F4789 ; font-weight:800">Gold Chart</h4>
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
                            label: 'Number of Gold',
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
        <div class="card mt-5" >
    <div class="card-header" style="background-color: #FFECB3;">
        <h4 style="color: #FF5733; font-size: 24px; font-weight: bold;">All Gold</h4>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table style="border: 2px solid #FFECB3; width: 100%; border-collapse: collapse;">
                <tr style="background-color: #FFECB3; color: #3B0D11;">
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">#</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Image</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Titlu</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Author</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Created At</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Price</th>
                    <th style="border: 2px solid #FFECB3; padding: 12px; font-size: 15px; font-weight: 900; color: #FF5733;">Details</th>
                </tr>
                @foreach ($golds as $index => $gold)
                <tr style="background-color: #fff;">
                    <td style="border: 2px solid #FFECB3; padding: 5px 10px; color: #FF5733; font-size: 14px; font-weight: 600;">{{ $index + 1 }}</td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px;"><img src="{{ $gold->banner }}" style="width: 60px" class="rounded-circle" alt="Imagine aur"></td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px; color: #3B0D11; font-size: 14px; font-weight: 600;">{{ $gold->title }}</td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px; color: #3B0D11; font-size: 14px; font-weight: 600;">{{ $gold->author }}</td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px; color: #3B0D11; font-size: 14px; font-weight: 600;">{{ $gold->created_at }}</td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px; color: #3B0D11; font-size: 14px; font-weight: 600;">{{ $gold->price }}</td>
                    <td style="border: 2px solid #FFECB3; padding:  5px 10px; color: #3B0D11; font-size: 14px; font-weight: 600;">{{ $gold->details }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer text-right">
            <nav class="d-inline-block">
                <ul class="pagination mb-0">
                    @if ($golds->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link" href="#"><i class="fas fa-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $golds->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                        </li>
                    @endif

                    @foreach ($golds->getUrlRange(1, $golds->lastPage()) as $page => $url)
                        @if ($page == $golds->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($golds->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $golds->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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
        </div>
    </div>
</section>

@endsection
