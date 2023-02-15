@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'Barangay',
    'activePage' => 'barangay',
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
            <h5 class="title">{{__(" Edit barangay")}}</h5>
          </div>
         

          <div class="card-body">
            @include('alerts.success',['key' => 'success'])
            
            <form method="post" action="{{ route('barangay.store') }}" autocomplete="off" enctype="multipart/form-data">
              @csrf           

            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Barangay")}}</label>
                                <input type="text" name="barangay" class="form-control" value="">
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__(" Shipping Price")}}</label>
                                <input type="nunmber" name="shipping" class="form-control" value="">
                           
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
                    <th>Barangay</th>
                    <th>Shipping</th>
                    <th>
                      
                    </th>               
                </tr></thead>
                <tbody>
                    @foreach($barangay as $barangay)
                    <tr>
                        <td>{{$barangay->barangay}}</td>
                        <td>{{$barangay->shipping}}</td>
                        <td>
                            <a data-toggle="modal" style='cursor:pointer' data-target="#edit{{ $barangay->id }}">                    
                                 <i class="fas fa-pen	"></i>
                            </a>

                            <a onclick="return confirm('Are you sure??')" href="{{ route('barangay.delete',['id'=>$barangay->id]) }}">                    
                                 <i class="far fa-window-close"></i>
                            </a>
                        </td>
                    </tr>

                    <div class="modal fade" id="edit{{$barangay->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Barangay</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form method="post" action="{{ route('barangay.update',['id'=>$barangay->id]) }}" autocomplete="off" enctype="multipart/form-data">
                              @csrf  
                              @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__(" Barangay")}}</label>
                                                <input type="text" name="barangay" class="form-control" value="{{ $barangay->barangay }}">
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{__(" Shipping Price")}}</label>
                                                <input type="nunmber" name="shipping" class="form-control" value="{{ $barangay->shipping }}">
                                          
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                          <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
                                    </div>
                                </div>  
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                          
                          </div>
                        </div>
                      </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
          </div> 
        </div>
      </div>
    </div>
   
@endsection