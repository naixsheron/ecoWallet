@extends('layouts.master')
 
@section('content')

<section class="section">

    
          <div class="text-right">
            <a href="{{ route('book.create') }}" class="btn btn-primary" id="modal-2">+ New Book</a>
        </div>

          <div class="row">
            <div class="col-12 col-md-5 col-lg-5">
              <?php

              $numBooks = \App\Models\Book::count();
              
              $completionPercentage = ($numBooks / 120) * 100;
              ?>
              
              <div class="card-header">
                <h4>Book Score</h4>
                <div class="progress mt-5">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $numBooks }}" aria-valuemin="0" aria-valuemax="12" style="width: {{ $completionPercentage}}%;">{{ $numBooks }} / 12</div>
                </div>
               </div>

               <div class="card">
                <div class="card-header">
                    <h4>Book Line Chart</h4>
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
            
            <div class="col-12 col-md-7 col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Read every month</h4>
                    </div>
                    <div class="card-body">
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
                            @endphp
                        
                            @for ($i = 0; $i < 120; $i++)
                                @php
                                    // Verificați dacă luna și anul curente există în baza de date created_at
                                    $hasRead = in_array($currentDate->format('F Y'), $monthsAndYearsInDatabase);
                                   

                                @endphp
                        
                                @if ($hasRead)
                                    <a href="#" class="btn btn-icon btn-success"><i class="fas fa-check"></i></a>
                                @else
                                    <a href="#" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></a>
                                @endif
                        
                                @php
                                    // Trecem la luna următoare
                                    $currentDate->addMonth();
                                @endphp
                            @endfor
                        </div>
                        
                        
                    </div>
                    
                </div>
                
                
              <div class="card">
                <div class="card-header">
                  <h4>All Books </h4>
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
                          <th>Pages</th>
                          <th>Details</th>
                      </tr>
                      
                      @foreach ($books as $index => $book)
                      <tr>
                          <td>{{ $index + 1 }}</td> <!-- Numerotarea va rămâne crescătoare -->
                          <td><img src="{{ $book->banner }}" style="width: 40px" alt="Imagine carte"></td>
                          <td>{{ $book->title }}</td>
                          <td>{{ $book->author }}</td>
                          <td>{{ $book->created_at }}</td>
                          <td>{{ $book->pages }}</td>
                          <td>{{ $book->details }}</td>
                      </tr>
                      @endforeach
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