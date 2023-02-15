@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Product Category',
    'activePage' => 'category',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Category")}}</h5>
          </div>


          <div class="card-body">
            <form method="post" action="{{ route('category.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf           

            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Category")}}</label>
                                <input type="text" name="category" class="form-control" value="">
                           
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
                    <th>Category</th>
                    <th>
                      
                    </th>               
                </tr></thead>
                <tbody>
                    @foreach($category as $category)
                    <tr>
                        <td>{{$category->categoryName}}</td>
                        <td>
                            <a onclick="return confirm('Are you sure??')" href="{{ route('category.delete',['id'=>$category->id]) }}">                    
                                 <i class="far fa-window-close"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div> 
        </div>
      </div>
    </div>
   
@endsection