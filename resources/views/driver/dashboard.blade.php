@extends('layouts.app', [
    'namePage' => 'Dashboard',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'home',
    'backgroundImage' => asset('now') . "/img/bg14.jpg",
])

@section('content')
  <div class="panel-header">
      @if(session('success'))
        @push('js')
          <script>
              showNotification('top','right');

              function showNotification(from, align){
                    color = 'primary';

                    $.notify({
                        icon: "now-ui-icons shopping_cart-simple",
                        message: "Order Success",

                    },{
                        type: color,
                        timer: 1000,
                        placement: {
                            from: from,
                            align: align
                        }
                    });
                }
          </script>   
        @endpush 
      @endif
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-chart">        
          <div class="card-body">            
            <center>
                <i style='font-size:50px' class="now-ui-icons shopping_cart-simple"></i>               
            </center>            
          </div> 
          <div class="card-footer bg-info">
                 <center>
                <a href="{{ route('driver.pending') }}" type="button" class="btn btn-info btn-block">
                    Pending Delivery <span class="badge badge-danger badge-pill">{{ $pending }}</span>
                </a>
                </center>  
          </div>         
        </div>
      </div> 

      <div class="col-lg-3">
        <div class="card card-chart">        
          <div class="card-body">            
            <center>
                <i style='font-size:50px' class="now-ui-icons shopping_box"></i>               
            </center>            
          </div> 
          <div class="card-footer bg-info">
                 <center>
                 <a href="{{ route('driver.finishList') }}" type="button" class="btn btn-info btn-block">
                    Finish <span class="badge badge-danger badge-pill">{{ $finish }}</span>
                 </a>
                </center>  
          </div>         
        </div>
      </div> 

     
      
      
      

  </div>
@endsection

