

<div class="sidebar" data-color="red">


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
        <div class="collapse show" id="product">
          <ul class="nav">            
            <li class="@if ($activePage == 'products') active @endif">
              <a href="{{ route('product.viewU') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("Products") }} </p>
              </a>
            </li>
          </ul>
        </div>
    </li>

    

       

      
    </ul>
  </div>
</div>



