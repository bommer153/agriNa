<?php 
  use App\http\Controllers\ProductsController;  
    $total = ProductsController::cartCount();
?>
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
  <div class="container-fluid">
    <div class="navbar-wrapper">
      <div class="navbar-toggle">
        <button type="button" class="navbar-toggler">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
    <a class="navbar-brand" href="">{{ $namePage }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
     
      <ul class="navbar-nav">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         
            <i class="now-ui-icons shopping_cart-simple">             
            </i>
             <span class="badge badge-pill badge-danger" id="totalCount">{{ $total }}</span>
            
          </a>
          <div class="dropdown-menu dropdown-menu-right" style='padding:10px 20px;width:400px;'> 
              @if($total == 0)
                <p>
                  <span class="d-md-block dropdown-item">No Items</span>
                 </p>
              @else
                  @php $details = ProductsController::cartDetails(); @endphp
                    
                      <table class="table">
                        <thead>
                          <tr>
                            <th >Qty</th>
                            <th >Prod</th>
                            <th >Price</th>                         
                          </tr>
                      </thead>
                      <tbody>
                        @php $subtotal = 0; @endphp
                        @foreach ($details as $de)
                          @php 
                            $totalPrice = $de->price * $de->totalq;
                            $subtotal = $subtotal + $totalPrice;
                          @endphp
                          <tr>
                              <td>{{$de->totalq}} x</td>
                              <td>{{ $de->name }}</td>
                              <td>P{{ $totalPrice }}</td>                              
                          </tr>
                        @endforeach
                    </tbody>
                    <tfooter>
                      <tr> 
                          <td></td>
                          <td></td>
                          <td>TOTAL : <b>{{ $subtotal }}</b></td>
                      </tr>
                    </tfooter>
                    </table>
                    <hr>
                    <a href="{{route('product.myCart')}}" style='color:black'>View Cart <i class="fas fa-long-arrow-alt-right"></i></a>   
              @endif
               
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="now-ui-icons users_single-02"></i>
            <p>
              <span class="d-lg-none d-md-block">{{ __("Account") }}</span>
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("My profile") }}</a>
            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __("Edit profile") }}</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- End Navbar -->