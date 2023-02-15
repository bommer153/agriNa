
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@if(Auth::User()->role == 1)
    @include('layouts.navbars.sidebar')
@elseif(Auth::User()->role == 2)
    @include('layouts.navbars.sideuser')
@else
    @include('layouts.navbars.sidedriver')
@endif
<div class="main-panel">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footer')
</div>