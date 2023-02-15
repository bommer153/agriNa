@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Pending',
    'activePage' => 'Pending',
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
            <h6 class="title">{{__("Pending Delivery")}}</h6>
          </div>
          <div class="card-body"> 

            <ul class="list-group">
                @foreach($orders as $ord)
                        @if($ord->status = '2')
                            @php $label = "Pending"; @endphp
                        @elseif($ord->status = '3')
                            @php $label = "Preparing"; @endphp
                        @elseif($ord->status = '4')
                            @php $label = "Shipping"; @endphp
                        @endif


                    <li  class="list-group-item list-group-item-secondary justify-content-between align-items-center"> 
                        Pending Transaction No.  <b style='cursor:pointer;' class='clickers' rel="{{$ord->id}}" id="click{{$ord->id}}">#{{ $ord->transactionNumber }}</b>             
                    </li>  
                   

                    
                    <div id="details{{ $ord->id }}" class='details' style='display:none;padding:10px;'>
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
                                                   <form action="{{ route('driver.finish',['transaction'=>$ord->transactionNumber]) }}" method='post'>
                                                        @method('PUT')
                                                        @csrf
                                                            <button onclick="return confirm('accept?')" class='btn btn-primary btn-round'>Finish</button>
                                                    </form>
                                                 </td>      
                                                @php $overall = $ord->shippingPrice + $totalPrice @endphp   
                                                <td>Overall Total: <b id="overall">{{ $overall }}</b></td>    
                                                <td></td>                   
                                            </tr>

                              
                                    
                                    </tfooter>
                                </table>

                                
                                <h2 style='cursor:pointer;' class='open' rel="{{$ord->id}}" id="click{{$ord->id}}">
                                    <i class='far fa-comment-alt'></i></h2>  
                                    
                                <div id="chatbox{{ $ord->id }}" class='row chatbox' style='display:none;'>
                               
                                            <div class="col-md-6">
                                                    <div class="card" >
                                                        <div class="card-body">
                                                            <ul  class="list-unstyled"> 
                                                                <div class='cbx' id="chatboxul{{ $ord->id }}" style='height:300px;overflow:auto;'>    
                                                                        @foreach($ord->chats as $chats) 
                                                                            @if($chats->sender == auth::user()->id)

                                                                                <li class="d-flex justify-content-between mb-4">                                                           
                                                                                    <div class="card w-100">                                                      
                                                                                        <div class="card-body">
                                                                                            <p class="mb-0"> {{ $chats->message }}                                             
                                                                                            </p>
                                                                                    </div>
                                                                                    </div>
                                                                                    <img src="{{ asset('storage/productImage/logo.png') }}" title="{{ auth::user()->name }}" alt="avatar"
                                                                                    class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                                                                </li>
                                                                            @else
                                                                                <li class="d-flex justify-content-between mb-4">
                                                                                    <img src="{{ asset('storage/productImage/logo.png') }}" title="{{ $ord->myDriver->name }}" alt="avatar"
                                                                                    class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                                                                    <div class="card">                                                              
                                                                                    <div class="card-body">
                                                                                        <p class="mb-0">
                                                                                            {{ $chats->message }}
                                                                                        </p>
                                                                                    </div>
                                                                                    </div>
                                                                                </li>

                                                                            @endif
                                                                        @endforeach     
                                                            
                                                                </div>
                                                                <li class="bg-white mb-3">
                                                                    <div class="form-outline">
                                                                    <textarea class="form-control message" id="message{{$ord->id}}" rel="{{ $ord->id }}" rows="4" placeholder="Message Here.."></textarea>
                                                                   
                                                                    </div>
                                                                </li>


                                                            <button type="button" class="btn btn-info btn-rounded float-end send" rel="{{ $ord->id }}" id="send">Send</button>
                                                            </ul>
                                                            
                                                        </div>
                                                    </div>
                                                </div>                                        
                                            </div>

</div>
                                      
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

        $('.open').click(function(){
            var id = $(this).attr('rel');            
            $('#chatbox'+id).slideToggle(); 
            $('#chatboxul'+id).scrollTop( 999999999999 );
                   
        });

        $('.send').click(function(){
         
            var id = $(this).attr('rel');
            var message = $('#message'+id).val(); 
                    
            var url = "{{ route('chat.sendMessage',['id'=>":id"]) }}";
            url = url.replace(':id', id);            
            $.ajax({
                url: url,
                type: "post",
                data: {"_token": "{{ csrf_token() }}",'message':message},
          
                  success: function (data) {                  
                    $('#chatboxul'+id).html(data.data);
                    $('#chatboxul'+id).scrollTop( 999999999999 );
                    $('#message'+id).val("");
                }       
            });
        });
    </script>
@endpush