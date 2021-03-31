

    <div class="c-wrapper">
      <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a class="c-header-brand d-sm-none" href="#"><img class="c-header-brand" src="{{ env('APP_URL', '') }}/assets/brand/coreui-base.svg" width="97" height="46" alt="CoreUI Logo"></a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        <?php
            use App\MenuBuilder\FreelyPositionedMenus;
            if(isset($appMenus['top menu'])){
                FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
            }
        ?>
        <ul class="c-header-nav ml-auto mr-4">
          <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="c-avatar"><img class="c-avatar-img" src="{{ asset('public/fassets/uploads/settings/App_Icon.png') }}" alt="user"></div>
            </a>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2"><strong>Language</strong></div>
                <a class="dropdown-item" href="{{ url("setlocale/en")}}">
                    <i class="cil-language c-icon mr-2"></i>English
                </a>
                    <a class="dropdown-item" href="{{ url("setlocale/uae")}}">
                            <i class="cil-language c-icon mr-2"></i>عربى</a>
              <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div>
              {{-- <a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="{{ asset('public/assets/icons/sprites/free.svg')}}#cil-user"></use>
                </svg> Profile</a> --}}
                {{-- <a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="{{ asset('public/assets/icons/sprites/free.svg')}}#cil-settings"></use>
                </svg> Settings</a> --}}
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="#">
                <svg class="c-icon mr-2">
                  <use xlink:href="{{ asset('public/assets/icons/sprites/free.svg')}}#cil-account-logout"></use>
                </svg><form action="{{ route('admin_logout') }}" method="POST"> @csrf <button type="submit" class="btn btn-ghost-dark btn-block">Logout</button></form></a>
            </div>
          </li>
        </ul>
        <div class="c-subheader px-3">
         <!--  <ol class="breadcrumb border-0 m-0"> -->
            {{-- <li class="breadcrumb-item"><a href="{{ route('admin.admin_dashboard') }}">Home</a></li> --}}
            {{-- <?php //$segments = ''; ?>
            @for($i = 1; $i <= 2; $i++)
                <?php //$segments .= '/'. Request::segment($i); ?>
                @if($i < count(Request::segments()))
                    <li class="breadcrumb-item">{{ Request::segment($i) }}</li>
                @else
                    <li class="breadcrumb-item active">{{ Request::segment($i) }}</li>
                @endif
            @endfor --}}
         <!--  </ol> -->
        </div>
    </header>
