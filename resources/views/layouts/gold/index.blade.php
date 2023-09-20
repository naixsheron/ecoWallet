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
                    <h4>Gold Chart</h4>
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
            <div class="card">
                <div class="card-header">
                    <h4>All Gold </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Titlu</th>
                                <th>Author</th>
                                <th>Created At</th>
                                <th>Price</th>
                                <th>Details</th>
                            </tr>
                            @foreach ($golds  as $index => $gold)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ $gold->banner }}" style="width: 40px" class="rounded-circle" alt="Imagine aur"></td>
                                <td>{{ $gold->title }}</td>
                                <td>{{ $gold->author }}</td>
                                <td>{{ $gold->created_at }}</td>
                                <td>{{ $gold->price }}</td>
                                <td>{{ $gold->details }}</td>
                    
                            </tr>
                            @endforeach
                        </table>
                    </div>
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
</section>

@endsection
