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
            <form method="post" action="{{ route('product.update',['id'=>$product[0]->pID]) }}" autocomplete="off" >
              @csrf           

            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ $product[0]->name }}">
                           
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Description")}}</label>
                              <textarea class="form-control" name="description">{{ $product[0]->description }}</textarea>                           
                        </div>
                    </div>
                    
                   

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Price")}}</label>
                                <input type="number" name="price" class="form-control" value="{{ $product[0]->price }}">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Quantity")}}</label>
                                <input type="number" name="quantity" class="form-control" value="{{ $product[0]->quantity }}">
                           
                        </div>
                    </div>

                    <div class="col-md-12">
                           <button type="submit" class="btn btn-primary btn-round">{{__('update')}}</button>
                    </div>
                </div>  
            </form>

            <hr>

            <!--image-->
            <form method="post" action="{{ route('product.addImage',['id'=>$product[0]->pID]) }}" enctype="multipart/form-data">
              @csrf           

            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label ><i id='filebutton' class='fa fa-upload'></i>  {{__(" image")}}</label>
                                <input type="file" id='image' accept="image/png, image/gif, image/jpeg" name="image[]" class="form-control" multiple required>
                           
                        </div>  
                    </div>
                    <div class="col-md-12">
                        <div class="row" id='preview'>
                            
                        </div>
                    </div>

                    <div class="col-md-12">
                           <button type="submit" class="btn btn-primary btn-round">{{__('add Image')}}</button>
                    </div>
                </div>  
            </form>
            <hr>

            <div class="row">
                @foreach($image as $image)
                    <div class="col-md-3">  
                            
                         <a style='position:absolute;left:87%;' href="" onclick="return confirm('Delete Image?')">
                             <span class="badge badge-danger">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                             </span>
                        </a> 

                        <img class='img-thumbnail' src="{{ asset('storage/productImage/'.$image->image) }}" alt="a">
                    
                        <a href="{{ route('product.setThumbnail',['image'=>$image->id,'id'=>$image->product]) }}" onclick="return confirm('Set as Thumbnail Image?')">
                             <span class="badge badge-info">Set Thumbnail                                 
                             </span>
                        </a>

                       
                        <br><br>
                    </div>
                @endforeach
            </div>
            
          </div> 
        </div>
      </div>
    </div>
   
@endsection

@push('js')
    <script>
        $(function() {
    // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            var s = event.target.result;
                            $($.parseHTML('<img with="150" height="150">')).attr('src', s).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#image').on('change', function() {
                imagesPreview(this, '#preview');
            });
        });
    </script>
@endpush