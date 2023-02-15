@extends('layouts.app', [
    'namePage' => 'verification',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'verification',
    'backgroundImage' => asset('assets') . "/img/agrina.jpg",
])

@section('content')
  <div class="content">
    <div class="container">
      <div class="col-md-12 ml-auto mr-auto">
          <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
              <div class="container">
                  <div class="header-body text-center mb-7">
                      <div class="row justify-content-center">
                          <div class="col-lg-4 col-md-4">
                              <h3 class="text-white">{{ __('Verification') }}</h3>
                              <p class="text-lead text-light mt-3 mb-0">
                                  @include('alerts.migrations_check')


                                    <div class="card card-chart">
                                      <div class="card-header">  
                                        @include('alerts.warning', ['key' => 'error'])                                  
                                        <h5 class="card-title">Code Verification</h5>
                                        <p class="description">Code has Sent to <b>{{ auth()->user()->email }}</b></p>
                                      </div>
                                      <div class="card-body">

                                        <div class="chart-area">
                                           
                                            <form method="post" action="{{ route('sms.verification') }}">
                                              @csrf()
                                                <label for="code">
                                                 <input type='number' id="code" name="code" class="form-control" placeholder="Verification Code">
                                                 <br>
                                                 <a href="{{ route('resend.code') }}">Resend Code</a>
                                                 </label><hr>
                                                 <button class='btn btn-primary btn-sm'>Continue</button>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                 
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4 ml-auto mr-auto">
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
@endpush
