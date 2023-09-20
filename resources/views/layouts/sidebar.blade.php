<div class="main-sidebar sidebar-style-2" style="background-color: #FFF3F0">
 <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">ecoWallet</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm ">
        <a href="index.html">eW</a>
      </div>
      <ul class="sidebar-menu mt-5">
          <div class="d-flex justify-content-center align-items-center">
             <img src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}" style="border-radius: 50% "  width="200px" alt="">
           </div>
          <h3 class="d-flex justify-content-center mt-3"><div class="d-sm-none d-lg-inline-block">
            @auth
                {{ auth()->user()->name }}
            @endauth
          
        </div></h3>
        @php
        $totalBooks = \App\Models\Book::count(); // Numărul total de cărți
        $totalGolds = \App\Models\Gold::count();
        $numMoney = \App\Models\Money::sum('price');
    
        // Normalizați procentajele pentru fiecare categorie
        $normalizedPercentageBook = ($totalBooks / 600) * 100; // Procent 1/5  (avem 6 categorii -> sa avem una ptionala)
        $normalizedPercentageGold = ($totalGolds / 150) * 100; // Procent 1/5  (avem 6 categorii)
        $totalPercentageGolds = ($numMoney / 500000) *100;
    
        // Adunați procentajele normalizate
        $totalPercentage = $normalizedPercentageBook + $normalizedPercentageGold + $totalPercentageGolds;
     
        @endphp
           <div class="product-review d-flex justify-content-center">
              @php
                $roundedTotalPercentage = round($totalPercentage/20); 
              @endphp
            @for ($i = 1; $i <= 5; $i++)
               @if ($i <= $roundedTotalPercentage)
                <i class="fas fa-star" style="color: yellow;"></i>
                   @else
                <i class="fas fa-star" style="color: grey;"></i>
               @endif
            @endfor
          </div>

  
    
          <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link mt-5"><i class="fas fa-fire"></i><span>Dashboard</span></a>
         
            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown {{ request()->is('gold*') ? 'active' : '' }}">
              <a href="{{ route('gold.index') }}" class="nav-link"><i class="fas fa-coins"></i> <span>GOLD eco</span></a>

         
            </li>
            <li class="dropdown {{ request()->is('book*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('book.index') }}"><i class="fas fa-book-reader"></i> <span>BOOK read</span></a></li>

            <li class="dropdown {{ request()->is('money*') ? 'active' : '' }}">
               <a href="{{ route('money.index') }}" class="nav-link "><i class="fas fa-money-bill-alt"></i> <span>MONEY bussines</span></a>
       
             </li>
       
             <li class="dropdown {{ request()->is('code*') ? 'active' : '' }}">
              <a href="{{ route('code.index') }}" class="nav-link  "><i class="fas fa-code"></i> <span>CODE home</span></a>
          
              <li class="dropdown {{ request()->is('crypto*') ? 'active' : '' }}">
              <a href="/crypto" class="nav-link "><i class="far fa-file-alt"></i> <span>CRIPTO eco</span></a>
    
             </li>
             <li class="dropdown {{ request()->is('land*') ? 'active' : '' }}">
                <a href="/land" class="nav-link "><i class="fas fa-map-marker-alt"></i> <span>LAND eco</span></a>
         
        
           
       
         </ul>
       
            
    </aside>
 </div>