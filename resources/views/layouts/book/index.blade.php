@extends('layouts.master')
 
@section('content')

<section class="section">
                  
          <div class="row ml-4 mr-4">
                <div class="col-12 col-md-6 col-lg-6">
                       <?php

                            $numBooks = \App\Models\Book::count();
              
                            $completionPercentage = ($numBooks / 120) * 100;
                         ?>
              
                      <div class="card-header">
                        <h4 style="color:#4F4789 ; font-weight:800">Book Score</h4>
                            <div class="progress mt-5">
                               <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $numBooks }}" aria-valuemin="0" aria-valuemax="12" style="width: {{ $completionPercentage}}%;">{{ $numBooks }} / 12</div>
                           </div>
                        </div>

                      <div class="card" style= "border:5px solid rgb(212, 207, 207) ; border-bottom-left-radius: 10%; border-bottom-right-radius: 10%; box-shadow:5px 10px 10px rgb(126, 125, 125)" >
                           <div class="card-header">
                               <h4 style="color:#4F4789 ; font-weight:800">Book Chart</h4>
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
                            label: 'Number of Books',
                            data: monthCount, // Numărul de cărți va fi reprezentat pe axa Y
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
            
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card" style= "background-color: #fceeee ; border:5px solid #ff5733 ; border-radius:4%; box-shadow:2px 5px 10px black">
                    <div class="card-header">
                        <h4 style="color: #ff5733; font-size: 22px; font-weight: 800;">Read every month </h4>
                    </div>
                    <div class="card-body ml-5 mr-3 mb-4 mt-2">
                        <div class="buttons">
                            @php
                                // Obțineți data primei înregistrări din baza de date
                                $firstRecordDate = $books->min('created_at');
                                
                                // Asigurați-vă că data primei înregistrări este validă
                                if ($firstRecordDate) {
                                    $currentDate = $firstRecordDate->startOfMonth();
                                } else {
                                    // Dacă nu există înregistrări, începeți cu o dată implicită
                                    $currentDate = now()->setDate(2023, 8, 1)->startOfMonth();
                                }
                                
                                // Inițializați un array cu lunile și anii din baza de date created_at
                                $monthsAndYearsInDatabase = [];
                        
                                foreach ($books as $book) {
                                    $bookMonthYear = date('F Y', strtotime($book->created_at));
                                    if (!in_array($bookMonthYear, $monthsAndYearsInDatabase)) {
                                        $monthsAndYearsInDatabase[] = $bookMonthYear;
                                    }
                                }
                                
                                // Obțineți luna curentă
                                $currentMonth = now()->startOfMonth();
                            @endphp
                        
                            @php
                                $prevHasRead = false;
                            @endphp
                        
                            @for ($i = 0; $i < 120; $i++)
                                @php
                                    // Verificați dacă luna curentă și luna următoare au date în baza de date created_at
                                    $hasRead = in_array($currentDate->format('F Y'), $monthsAndYearsInDatabase);
                                    $nextMonthHasRead = in_array($currentDate->copy()->addMonth()->format('F Y'), $monthsAndYearsInDatabase);
                                @endphp
                        
                                @if ($hasRead)
                                    <a href="#" style="width:45px ; height:30px" class="btn btn-icon btn-success"><i style="font-size:20px" class="fas fa-check"></i></a>
                                @elseif ($prevHasRead || $nextMonthHasRead)
                                    <a href="#" style="width:45px ; height:30px" class="btn btn-icon btn-danger"><i style="font-size:20px" class="fas fa-times"></i></a>
                                @else
                                <a href="#" style="width:45px ; height:30px" class="btn btn-icon btn-light"><i style="font-size:15px ; color:#ff5733" class="fas fa-star"></i></a>
                                @endif
                        
                                @php
                                    // Actualizați variabila $prevHasRead pentru luna anterioară
                                    $prevHasRead = $hasRead;
                                    // Trecem la luna următoare
                                    $currentDate->addMonth();
                                @endphp
                            @endfor
                          </div>
                       </div>           
                   </div>

            </div>
        </div>
        <div class="row ml-4 mr-4">
            <div class="col-12">
            <div class="card" style="border:10px solid #ff5733; border-radius:7%; box-shadow:2px 5px 10px black">
                <div class="card-header d-flex justify-content-between " style="width: 100%">
                    <div><h4 style="color: #ff5733; font-size: 22px; font-weight: 800;">Reads</h4></div>
                    <div class=" ml-5">
                        <a href="{{ route('book.create') }}" class="btn btn-primary" id="modal-2">+ New Book</a>
                 </div>
                </div>
                <div class="card-body p-0 rounded-top">
                    <div class="table-responsive">
                        <table style="border: 2px solid #ff5733; width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #ff5733;">
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">#</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Image</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Titlu</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Author</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Created At</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Pages</th>
                                    <th style="border: 2px solid #ff5733; padding: 12px; color: #fff; font-size: 20px;">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $index => $book)
                                <tr style="background-color: #fceeee;">
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $index + 1 }}</td> 
                                    <td style="border: 2px solid #ff5733; padding: 12px;"><img src="{{ $book->banner }}" style="width: 60px" alt="Imagine carte"></td>
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $book->title }}</td>
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $book->author }}</td>
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $book->created_at }}</td>
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $book->pages }}</td>
                                    <td style="border: 2px solid #ff5733; padding: 12px; color: #ff5733; font-size: 18px; font-weight: 700;">{{ $book->details }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            @if ($books->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" href="#"><i class="fas fa-chevron-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->previousPageUrl() }}"><i class="fas fa-chevron-left"></i></a>
                                </li>
                            @endif
                            
                            @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                @if ($page == $books->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                            
                            @if ($books->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
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