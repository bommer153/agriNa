@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Orders',
    'activePage' => 'orders',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row"> 
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="title">{{__("Pending Orders")}}</h6>
          </div>
          <div class="card-body"> 

            <ul class="list-group">
                @foreach($orders as $ord)
                    @if($ord->status = '2')
                        @php $label = "Pending"; @endphp
                    @elseif($ord->status = '3')
                        @php $label = "Preparing"; @endphp
                    @endif
                    <li  class="list-group-item justify-content-between align-items-center" > 
                    Trans <b style='cursor:pointer;' class='clickers' rel="{{$ord->id}}" id="click{{$ord->id}}">#{{ $ord->transactionNumber }}</b>             
                                              
                            <div id="details{{ $ord->id }}" class='details' style='display:none'>
                                <hr>  
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class=''>{{ $ord->users->name }}</p>
                                        <p class=''>Contact <b>{{ $ord->users->contact }}</b></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class=''>Address : <b>{{ $ord->myAddress->address }} {{ $ord->myAddress->barangayR->barangay }} {{ $ord->myAddress->city }}</b></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class=''>{{  date("M d, Y", strtotime($ord->updated_at)) }}</p>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                        
                                            <td><b>Qty</b></td>       
                                            <td style='width:80px'><b></b></td>                    
                                            <td><b>Product</b></td>
                                            <td><b>Unit Price</b></td>
                                            <td><b>Total</b></td>                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $totalPrice = 0; @endphp
                                    @foreach($ord->cart as $cart)
                                        @php 
                                            $subTotal = $cart->quantity * $cart->unitPrice; 
                                            $totalPrice = $totalPrice + $subTotal;                                       
                                        @endphp
                                            <tr>

                                                <td>x{{ $cart->quantity }} </td>
                                                <td><img src="{{ asset('storage/productImage/'.$cart->productzz[0]->thumbnail) }}" class="img-thumbnail" style='width:80px;'></td>
                                                <td>{{ $cart->productzz[0]->name }}</td>
                                                <td>{{ $cart->unitPrice}} </td>
                                                <td>{{ $subTotal }} </td>
                                            </tr>
                                    @endforeach  
                                    </tbody>
                                    <tfooter>
                                    <tr>
                                        <td colspan='3'>Shipping Price: <b id="shippingz">{{$ord->shippingPrice}}</b></td>   
                                                                                                      
                                        <td>Sub Total: <b id="sstotal">{{ $totalPrice }}</b></td>
                                        <td></td>
                                        <td></td>
                                        </tr>


                                        <tr>          
                                          

                                                 <td colspan="3">
                                                     <form action="{{ route('transaction.accept',['transaction'=>$ord->transactionNumber]) }}" method='post'>
                                                        @method('PUT')
                                                        @csrf
                                                            <button onclick="return confirm('accept?')" class='btn btn-primary btn-round'>Accept</button>
                                                    </form>
                                                </td>  
                                             
                                            @php $overall = $ord->shippingPrice + $totalPrice @endphp   
                                            <td>Overall Total: <b id="overall">{{ $overall }}</b></td>    
                                            <td></td>                   
                                        </tr>

                                        <tr>
                                                                                            
                                                
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>
                    </li>
                      
                @endforeach                
            </ul>
               
          </div> 
        </div>
      </div>
    </div>
   
@endsection
@push('js')
    <script>
       $('.clickers').click(function(){
            var id = $(this).attr('rel');            
            $('#details'+id).slideToggle();  
                   
        });
    </script>
@endpush