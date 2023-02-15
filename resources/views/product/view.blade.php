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
            <h5 class="title">{{__(" Edit Product")}}</h5>
          </div>


          <div class="card-body">
            <form method="post" action="{{ route('product.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf           

            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control" value="">
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Description")}}</label>
                              <textarea class="form-control" name="description"></textarea>                           
                        </div>
                    </div>

                

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Price")}}</label>
                                <input type="number" name="price" class="form-control" value="">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Quantity")}}</label>
                                <input type="number" name="quantity" class="form-control" value="">
                           
                        </div>
                    </div>

                    <div class="col-md-12">
                           <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
                    </div>
                </div>  
            </form>

            <hr>

            <table class='table'>
                <thead><tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th> 
                    <th>Price</th> 
                    <th>Quantity</th>   
                                
                </tr></thead>
                <tbody>
                    @foreach($product as $prod)
                    <tr>
                        <td><img src="{{ asset('storage/productImage/'.$prod->thumbnail) }}" class="img-thumbnail" style='width:80px;' title='{{ $prod->description }}'></td>
                        <td><a href='{{ route("product.show",["id"=>$prod->pID]) }}'>{{ $prod->name }}</a></td>
                        <td>{{ $prod->categoryName }}</td>
                        <td>P {{$prod->price}}</td>
                        <td>{{ $prod->quantity }}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div> 
        </div>
      </div>
    </div>
   
@endsection