@extends('layouts.app', [
    'class' => 'sidebar-mini ',
    'namePage' => 'User Profile',
    'activePage' => 'profile',
    'activeNav' => '',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
    <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="{{asset('assets')}}/img/bg5.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
              <a href="#">
                <img class="avatar border-gray" src="{{asset('assets')}}/img/default-avatar.png" alt="...">
                <h5 class="title">{{ $user->name }}</h5>
              </a>
              <p class="description">
                  {{ $user->email }}
              </p>
            </div>
          </div>  
        </div>
      </div>

      <div class="col-md-8">        
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Driver Profile")}}</h5>
          </div>

        <!-- Profile -->
          <div class="card-body">
            <form method="post" action="" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                
                
                  <div class="col-md-6 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                      @include('alerts.feedback', ['field' => 'email'])
                    </div>
                  </div>
                </div>


              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>
        <!-- Files -->
          <div class="card-header">
            <h5 class="title">{{__("Driving Credential")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('driver.addLicense',['id'=>$user->id]) }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success',['key'=>'license'])
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>{{__("Driver License")}}</label>
                                <input type="text" name="license" class="form-control" value="{{ $user->license }}">                               
                        </div>
                      </div>
                      <div class="col-md-6 pr-1">
                        <div class="form-group">  
                          <br>                          
                            <label style='cursor:pointer;'><b><i class="now-ui-icons files_paper"></i> {{__("Attach Files")}} </b></label>
                                <input type="file" name="file" class="form-control" value="" multiple>
                       
                        </div>
                      </div> 
                    
                </div>
           

              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>
          </div>


        <!-- password -->
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="" autocomplete="off">
              @csrf
              @method('put')
              @include('alerts.success', ['key' => 'password_status'])
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" Current Password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="old_password" placeholder="{{ __('Current Password') }}" type="password"  required>
                    @include('alerts.feedback', ['field' => 'old_password'])
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 pr-1">
                  <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label>{{__(" New password")}}</label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" type="password" name="password" required>
                    @include('alerts.feedback', ['field' => 'password'])
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-7 pr-1">
                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                  <label>{{__(" Confirm New Password")}}</label>
                  <input class="form-control" placeholder="{{ __('Confirm New Password') }}" type="password" name="password_confirmation" required>
                </div>
              </div>
            </div>
            <div class="card-footer ">
              <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
     
    </div>
  </div>
@endsection