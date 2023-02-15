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
                <h5 class="title">{{ auth()->user()->name }}</h5>
              </a>
              <p class="description">
                  {{ auth()->user()->email }}
              </p>
           
              <h5>
                  User Address 
              </h5>
                <table class="table">
                   
                    @foreach(auth()->user()->address()->get() as $address)
                      <tr>
                          <td><i>{{ $address->address }} {{ $address->barangayR->barangay }} {{ $address->city }}</i></td>
                          <td>
                              <a href="" onclick='return confirm("Delete Address?")'>
                               <i class='fas fa-window-close' title='Delete Address'></i>
                              </a>
                          </td>
                        </tr>
                    @endforeach
                </table>
            </div>
          </div>         
        </div>
      </div>



      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">{{__(" Edit Profile")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.update') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf
              @method('put')
              @include('alerts.success')
              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-7 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                                @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', auth()->user()->email) }}">
                      @include('alerts.feedback', ['field' => 'email'])
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-7 pr-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">{{__(" Contact")}}</label>
                      <input type="text" name="contact" class="form-control" placeholder="contact" value="{{ old('email', auth()->user()->contact) }}">
                      @include('alerts.feedback', ['field' => 'contact'])
                    </div>
                  </div>
                </div>

              <div class="card-footer ">
                <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
              </div>
              <hr class="half-rule"/>
            </form>

            <form method="post" action="{{ route('user.addAddress') }}" autocomplete="off"
            enctype="multipart/form-data">
              @csrf           
              @include('alerts.success',['key' => 'address'])
              @include('alerts.warning', ['key' => 'addAddress'])

              <div class="row">
              </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Unit/blk/lot/purok, street </label>
                                <input type="text" name="address" class="form-control" required>
                               
                        </div>
                    </div>

                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Barangay </label>
                              <select name="barangay" class="form-control" required>
                                  @foreach($barangay as $barangay)
                                      <option value="{{$barangay->id}}">{{ $barangay->barangay }}</option>
                                  @endforeach
                              </select>
                        </div>
                    </div>

                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>City </label>
                                <input type="text" name="city" class="form-control" value="Olongapo" required>                               
                        </div>
                    </div>


                    <div class="col-md-6 pr-1">
                        <button type="submit" class="btn btn-primary btn-round">Save Address</button>
                    </div>
                </div>               
              
               
              
              <hr class="half-rule"/>
            </form>



          </div>
          <div class="card-header">
            <h5 class="title">{{__("Password")}}</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
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