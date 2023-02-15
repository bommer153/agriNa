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
            <h6 class="title">{{__("My Cart")}}</h6>
          </div>
          <div class="card-body"> 
            <table class="table">
                <thead>
                    <tr>
                       
                        <td style='width:50px;'><b>Qty</b></td>                      
                        <td style="width:200px;"><b>Product</b></td>
                        <td><b>Unit Price</b></td>
                        <td><b>Total</b></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @php $totalPrice = 0; @endphp
                @foreach($cart as $cart)
                    @php 
                        $subTotal = $cart->totalq * $cart->price; 
                        $totalPrice = $totalPrice + $subTotal;
                        $max = $cart->quantity + $cart->totalq;
                    @endphp
                        <tr>
                            
                            <td>  
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id='minus{{$cart->cartID}}' rel="{{$cart->cartID}}" type="button" class="btn btn-primary btn-sm minus" >
                                            <span class="fas fa-minus"></span>
                                        </button>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" name="quantity" rel="{{ $cart->quantity }}" id="quantity{{$cart->cartID}}" class="form-control quantity" value="{{ $cart->totalq }}" min="1" max="{{ $max }}" readonly>                      

                                    </div>
                                    <div class="col-md-12">
                                        <button id='plus{{$cart->cartID}}' rel="{{$cart->cartID}}" type="button" class="btn btn-primary btn-sm plus">
                                            <span class="fas fa-plus"></span>
                                        </button>
                                    </div>
                                </div>                                 
                            </td>
                           
                          
                            <td id='product{{$cart->cartID}}' rel="{{ $cart->product }}">{{ $cart->name }}</td>
                            <td id='unitPrice{{$cart->cartID}}'>{{ $cart->price}} </td>
                            <td id='subTotal{{$cart->cartID}}'>{{ $subTotal}} </td>
                            <td>                            
                                <a onclick="return confirm('Are you sure??')" href="{{ route('cart.delete',['id'=>$cart->cartID , 'transaction'=>$cart->transaction]) }}">                    
                                    <i class="far fa-window-close"></i>
                                </a>
                            </td>
                        </tr>
                @endforeach  
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan='3'>Shipping Price: <b id="shippingz"></b></td>           
                        <td>Sub Total: <b id="sstotal">{{ $totalPrice }}</b></td>
                       
                    </tr>
                    <tr>          
                        <td colspan="3"></td>       
                        <td>Overall Total: <b id="overall"></b></td>   
                      

                                        
                    </tr>
                    <tr>
                        

                            <form action="{{ route('transaction.order',['transaction'=>$transaction->transactionNumber]) }}" method='post'>
                              
                            <td colspan="3">
                               @method('PUT')
                                @csrf
                                <label>Shipping Address</label>
                                <select class='form-control shipp' id="Caddress" name='address'>
                                    @foreach(auth()->user()->address()->get() as $address)
                                        <option class="ship" id="shipers" rel="g{{$address->id}}" ship="{{ $address->barangayR->shipping }}" value="{{ $address->id }}">{{ $address->address }} {{ $address->barangayR->barangay }} {{ $address->city }}</option>  
                                    @endforeach        
                                </select>
                                <input type='hidden' id="shipz" name="shipping">
                            </td>
                                
                            <td>

                                <button onclick="return confirm('proceed?')" class='btn btn-primary btn-round'>Proceed Order</button>
                            </td>

                            </form>                        
                    </tr>
                </tfooter>  
            </table>        
          </div> 
        </div>
      </div>
    </div>
   
@endsection
@push('js')
    <script>
        $( document ).ready(function() {
            var ship = $('.ship').attr('ship');
            var sub = $('#sstotal').text();
            var overall = parseInt(ship) + parseInt(sub);           
            $('#shippingz').text(ship);
            $('#overall').text(overall);
            $('#shipz').val(ship);
        });

        $('#Caddress').change(function(){ 
            var ship = $('option:selected', this).attr('ship');
            var sub = $('#sstotal').text();
            var overall = parseInt(ship) + parseInt(sub);           
            $('#shippingz').text(ship);
            $('#overall').text(overall);
            $('#shipz').val(ship);
        })

        $('#editQty').click(function(){
            $('.quantity').prop('disabled',false);
        })

        $('.plus').click(function(){  
            var id = $(this).attr('rel');          
            var quantity = $('#quantity'+id).val();
            var prodqty = $('#quantity'+id).attr('rel');
            var max = $('#quantity'+id).attr('max');
            var price = $('#unitPrice'+id).text();
            var product =  $('#product'+id).attr('rel');   
            var sstotal = $('#sstotal').text();
            $('#minus'+id).prop('disabled','');           
            quantity = parseInt(quantity);            
            max = parseInt(max);
            prodqty = parseInt(prodqty);   
            sstotal = parseInt(sstotal);  
            price = parseInt(price);
            if(quantity >= max){
                $('#quantity'+id).val(max);
                $(this).prop('disabled','disabled');
            }else{
                quantity = quantity + 1;
                $('#quantity'+id).val(quantity);

                
            }
              
                var subTotal = price * quantity;      
                prodqty = prodqty - 1;  
                sstotal = sstotal + price;
                $('#sstotal').text(sstotal); 
                $('#subTotal'+id).html(subTotal); 
                
                var ship = $('.ship').attr('ship');
                var overall = sstotal + parseInt(ship);
                $('#overall').text(overall);
                
            
            var url = "{{ route('product.quantityUpdate',['id'=>":id"]) }}";
            url = url.replace(':id', id);            
            $.ajax({
                url: url,
                type: "post",
                data: {"_token": "{{ csrf_token() }}",'quantity':quantity,'newStock':prodqty,'product':product,'ship':ship},
                  success: function (data) {  
                   
                    
                }    
            });
                
        });

        $('.minus').click(function(){ 
            var id = $(this).attr('rel');                
            var quantity = $('#quantity'+id).val();   
            var max = $('#quantity'+id).attr('max');  
            var product =  $('#product'+id).attr('rel');    
            var prodqty = $('#quantity'+id).attr('rel'); 
            $('#plus'+id).prop('disabled','');            
            var price = $('#unitPrice'+id).text();
            var sstotal = $('#sstotal').text();
            quantity = parseInt(quantity);
            prodqty = parseInt(prodqty);  
            sstotal = parseInt(sstotal);  
            price = parseInt(price);

            if(quantity <= 1){
                $('#quantity'+id).val(1);
                $(this).prop('disabled','disabled');
            }else{
                quantity = quantity - 1;
                $('#quantity'+id).val(quantity);
            }  
               
            var subTotal = price * quantity;
            prodqty = prodqty + 1;   
            sstotal = sstotal - price;   
            $('#sstotal').text(sstotal);  
            $('#subTotal'+id).html(subTotal); 
            
            var ship = $('.ship').attr('ship');
            var overall = sstotal + parseInt(ship);
            $('#overall').text(overall);
      

            var url = "{{ route('product.quantityUpdate',['id'=>":id"]) }}";
            url = url.replace(':id', id);   
            $.ajax({
                url: url,
                type: "post",
                data: {"_token": "{{ csrf_token() }}",'quantity':quantity,'newStock':prodqty,'product':product,'ship':ship},
                  success: function (data) {  
                     
                }    
            });

                   
        });
    </script>
@endpush