<div class="sidebar" data-color="orange">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->

  <div class="logo">
    <a href="" class="simple-text logo-mini">
      {{ __('AGRINA') }}
    </a>
    <a href="" class="simple-text logo-normal">
      {{ __('AGRINA') }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li>
        <a data-toggle="collapse" href="#product">
            <i class="fas fa-seedling"></i>
          <p>
            {{ __("Products") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="product">
          <ul class="nav">
       
            <li class="@if ($activePage == 'products') active @endif">
              <a href="{{ route('product.view') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Products") }} </p>
              </a>
            </li>
          </ul>
        </div>
    </li>

    <li>
        <a data-toggle="collapse" href="#transaction">
            <i class="fas fa-inbox"></i>
          <p>
            {{ __("Transaction") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="transaction">
          <ul class="nav">
            <li class="@if ($activePage == 'orders') active @endif">
              <a href="{{ route('pending.order') }}">
                <i class="fas fa-inbox"></i>
                <p> {{ __("Pending Order") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'preparation') active @endif">
              <a href="{{ route('transaction.preparation') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("preparation") }} </p>
              </a>
            </li>

            <li class="@if ($activePage == 'shipping') active @endif">
              <a href="{{ route('transaction.shipping') }}">
                <i class="now-ui-icons shopping_delivery-fast"></i>
                <p> {{ __("Shipping") }} </p>
              </a>
            </li>

            <li class="@if ($activePage == 'finish') active @endif">
              <a href="{{ route('transaction.finish') }}">
                <i class="now-ui-icons shopping_box"></i>
                <p> {{ __("Finish") }} </p>
              </a>
            </li>
          </ul>
        </div>
    </li>

    <li>
        <a data-toggle="collapse" href="#user">
            <i class="fas fa-user"></i>
          <p>
            {{ __("User") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="user">
          <ul class="nav">
            <li class="@if ($activePage == 'user') active @endif">
              <a href="{{ route('user') }}">
                <i class="now-ui-icons users_circle-08"></i>
                <p> {{ __("User Consumer") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'driver') active @endif">
              <a href="{{ route('user.driver') }}">
                <i class="fas fa-shuttle-van"></i>
                <p> {{ __("Driver") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'barangay') active @endif">
              <a href="{{ route('barangay') }}">
                <i class="fas fa-synagogue"></i>
                <p> {{ __("Barangay") }} </p>
              </a>
            </li>
          </ul>
        </div>
    </li>
    
     <!-- <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="fab fa-laravel"></i>
          <p>
            {{ __("User") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'profile') active @endif">
              <a href="{{ route('profile.edit') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("User Profile") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'users') active @endif">
              <a href="{{ route('user.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("User Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
</li>-->
       
  <!--
      <li class="@if ($activePage == 'icons') active @endif">
        <a href="{{ route('page.index','icons') }}">
          <i class="now-ui-icons education_atom"></i>
          <p>{{ __('Icons') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'maps') active @endif">
        <a href="{{ route('page.index','maps') }}">
          <i class="now-ui-icons location_map-big"></i>
          <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'notifications') active @endif">
        <a href="{{ route('page.index','notifications') }}">
          <i class="now-ui-icons ui-1_bell-53"></i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'table') active @endif">
        <a href="{{ route('page.index','table') }}">
          <i class="now-ui-icons design_bullet-list-67"></i>
          <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'typography') active @endif">
        <a href="{{ route('page.index','typography') }}">
          <i class="now-ui-icons text_caps-small"></i>
          <p>{{ __('Typography') }}</p>
        </a>
      </li>
-->
      
    </ul>
  </div>
</div>
