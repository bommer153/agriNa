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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h6 class="title">Product</h6>
          </div>
          <div class="card-body">            
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('storage/productImage/'.$product[0]->thumbnail) }}" style='width:300px;height:300px;' class='img-thumbnail' id='thumb'>
                    
                </div>
                <div class="col-md-8">
                    <p><b>Description : </b> {{ $product[0]->description }}</p>
                    
                    <p>Stock : <b id="stock">{{ $product[0]->quantity }}</b> pc/s</p>

                    <p>Price : <b>P {{ $product[0]->price }}</b> </p>
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button id='minus' type="button" class="btn btn-primary" disabled='disabled'>
                                        <span class="fas fa-minus"></span>
                                    </button>
                                </span>

                               {{ csrf_field() }}

                                <input type="text" name="quantity" id="quantity" class="form-control" value="1" min="1" max="{{ $product[0]->quantity }}" readonly>
                                <span class="input-group-btn">
                                    <button id='plus' type="button" class="btn btn-primary">
                                        <span class="fas fa-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>

                            <div class="col-md-8"><br>
                                <p>Total : P<span id='total'><b>  {{ $product[0]->price }}</b></span></p>
                            </div>
                            <div class="col-md-4">
                                <button  type="button" id="addToCart" class="btn btn-primary">
                                    <span class="fas fa-shopping-cart"> Add to Cart</span>
                                </button>
                            </div>
                    </div>
                    
                </div> 
                <div class="col-md-12">
                    <h4><b>{{ $product[0]->name }}</b></h4>
                    Product Image
                    <div class="row">                       
                        @foreach($image as $image)
                            <div class="col-md-2">
                            <img src="{{ asset('storage/productImage/'.$image->image) }}"  id="image{{$image->id}}"style='height:100px;' class='img-thumbnail setImage'>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
   
@endsection

@push('js')
    <script>
        
      

        $('.setImage').hover(function(){
            var image = $(this).attr('src');
            $('#thumb').prop('src',image);
        });

        $('#plus').click(function(){            
            var quantity = $('#quantity').val();
            var max = $('#quantity').attr('max');
            var price = "{{ $product[0]->price }}";            
            $('#minus').prop('disabled','');           
            quantity = parseInt(quantity);            
            max = parseInt(max);
         
            if(quantity >= max){
                $('#quantity').val(max);
                $(this).prop('disabled','disabled');
            }else{
                quantity = quantity + 1;
                $('#quantity').val(quantity);
            }
            price = price * quantity;
            $('#total').html("<b> "+price+"</b>");
                
        });

        $('#minus').click(function(){            
            var quantity = $('#quantity').val();            
            $('#plus').prop('disabled','');
            quantity = parseInt(quantity);
            var price = "{{ $product[0]->price }}";  

            if(quantity <= 1){
                $('#quantity').val(1);
                $(this).prop('disabled','disabled');
            }else{
                quantity = quantity - 1;
                $('#quantity').val(quantity);
            }   

            price = price * quantity;
            $('#total').html("<b> "+price+"</b>");            
        });

        $('#addToCart').click(function(){
           
            var quantity = $('#quantity').val();       
          
            
            $.ajax({
                url: "{{ route('product.addCart',['id'=>$product[0]->pID]) }}",
                type: "post",
                data: {"_token": "{{ csrf_token() }}",'quantity':quantity,"stock":"{{ $product[0]->quantity }}"},
                  success: function (data) {   
                    $('#stock').text(data.stock);
                    $('#quantity').attr('max',data.stock);
                    showNotification('bottom','right','{{ $product[0]->name; }}')
                    setInterval(function () {
                        window.location.assign("{{ route('product.viewU') }}")       
                     }, 2000);
                   
                    
                }    
            });
        })


        function showNotification(from, align,product){
            color = 'primary';

            $.notify({
                icon: "now-ui-icons shopping_cart-simple",
                message: "<b>"+product +"</b> added to cart",

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