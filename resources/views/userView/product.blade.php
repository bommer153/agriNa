@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Product',
    'activePage' => 'products',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
        

      <div class="col-md-9">
        <div class="card">
          <div class="card-header">
            <h6 class="title">{{__("Agrina Product")}}</h6>
          </div>
          <div class="card-body">            
            <div class="row">
                @foreach($product as $product)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                 <img src="{{ asset('storage/productImage/'.$product->thumbnail) }}" height='120' class="img-rounded border" title='{{$product->description}}'>                       
                                </center>
                                 <br><br>
                                <p class='title text-center'>{{ $product->name }}
                                    <span> <p class='text-center'><i>P {{ $product->price }}</i></p></span>
                                </p>
                               
                            </div>
                            <div class="card-footer">
                            <a  href="{{ route('product.showU',['id'=>$product->pID]) }}" style='color:black'>View Product <i class="fas fa-long-arrow-alt-right"></i></a>   
                              
                            </div>                            
                        </div>
                    </div>
                @endforeach
            </div>
          </div> 
        </div>
      </div>
    </div>
   
@endsection