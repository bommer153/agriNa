<div class="wrapper wrapper-full-page ">
    @if(auth()->check())
        @if(auth()->user()->smsverification == 0)
            @include('layouts.navbars.navs.verification')
        @else
            @include('layouts.navbars.navs.guest')
        @endif
    @else
         @include('layouts.navbars.navs.guest')
    @endif

    @php $backgroundImage = asset('assets') . "/img/agrina.jpg"; @endphp
   
    <div class="full-page register-page section-image" filter-color="black" data-image="{{ $backgroundImage }}">
        @yield('content')
        @include('layouts.footer')
    </div>
</div>
