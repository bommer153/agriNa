@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User',
    'activePage' => 'users',
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
            <h6 class="title">{{__("Users")}}</h6>
          </div>
          <div class="card-body"> 
               <div class="row">
                  <div class="col-md-6">
                    <table class="table">
                                    <thead>
                                        <tr>                                        
                                            <td><b>Name</b></td>       
                                            <td><b>Email</b></td>              
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                    @foreach($user as $user)                                       
                                            <tr>
                                                <td><a href="{{ route('driver.show',['id' => $user->id]) }}">{{ $user->name }}</a></td>                                               
                                                <td>{{ $user->email }}</td>                                               
                                            </tr>
                                    @endforeach  
                                    </tbody>                                    
                                </table>
                            </div>
                    </li>
                      
                        
            </ul>
               
          </div> 
        </div>
      </div>
    </div>
   
@endsection
@push('js')
    
@endpush