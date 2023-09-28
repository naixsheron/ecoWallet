@extends('layouts.master')

@section('content')

<section class="section" style="max-width: 1850px">

    <div class="row ml-1 mr-1">
        <div class="col-12 col-md-6 col-lg-6 mt-3" >
            <?php
            // Numărați gold-urile din baza de date
            $numGolds = \App\Models\Gold::count();

            // Calculați procentajul completat
            $completionPercentage = ($numGolds / 32) * 100;
            ?>

                  <div class="card-header" style="margin-top:-15px; border:5px solid rgb(212, 207, 207) ; border-top-left-radius: 10%; border-top-right-radius: 10%; box-shadow:5px 10px 10px rgb(126, 125, 125)">
                       <h4>Gold Score</h4>
                       <div class="progress mt-5">
                           <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $numGolds }}" aria-valuemin="0" aria-valuemax="32" style="width: {{ $completionPercentage}}%;">{{ $numGolds }} / 32</div>
                      </div>
                 </div>
                 <div class="card" style= "padding-bottom:10px; border:5px solid rgb(212, 207, 207) ; border-bottom-left-radius: 10%;  border-bottom-right-radius: 10%; box-shadow:5px 10px 10px rgb(126, 125, 125)" >
                        <div class="card-header">
                             <h4 style="color:#4F4789 ; font-weight:800">Gold Chart</h4>
                       </div>
                       <div class="card-body">
                            <canvas id="myLineChart"></canvas>
                      </div>
                </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                let months = @json($months); 
                let monthCount = @json($monthCount); 

                let ctx = document.getElementById('myLineChart').getContext('2d');
                let myLineChart = new Chart(ctx, {
                    type: 'line', 
                    data: {
                        labels: months, 
                        datasets: [{
                            label: 'Number of Gold',
                            data: monthCount, 
                            borderColor: '#6777ef', 
                            borderWidth: 4, 
                            fill: false 
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true 
                            }
                        }
                    }
                });
            </script>

        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card  " style="border:8px solid #FF5733; border-bottom-left-radius: 8%;  border-bottom-right-radius: 8%; box-shadow: 15px 10px 25px 15px #FFECB3" >
                   <div class="card-header d-flex justify-content-between" style="background-color: #FFECB3;">
                     <div><h4 style="color: #FF5733; font-size: 24px; font-weight: 900;">Gold</h4></div>
                       <div class="text-right ml-5">
                           <a href="{{ route('gold.create') }}" class="btn btn-primary" id="modal-2">+ New Gold</a>
                       </div>
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
</section>
@endsection
