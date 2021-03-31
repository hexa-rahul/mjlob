<div class="c-sidebar-brand">
    {{-- <img class="c-sidebar-brand-full" src="{{ asset('public/fassets/uploads/settings/App_Icon2.png') }}" width="118" height="46" alt="CoreUI Logo">  --}}
     {{-- <img class="c-sidebar-brand-minimized" src="{{ asset('public/fassets/uploads/settings/App_Icon2.png') }}" width="118" height="46" alt="CoreUI Logo">  --}}
    <samp class="c-sidebar-brand-minimized">{{ trans('lang.project_name') }}</samp>
    <samp class="c-sidebar-brand-full">{{ trans('lang.project_name') }}</samp>
</div>
<ul class="c-sidebar-nav ps">
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link c-active" href="{{ url('admin/admin_dashboard') }}">
            <i class="cil-speedometer c-sidebar-nav-icon"></i>
            {{ trans('lang.Dashboard') }}</a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/user/list') }}">
            <i class="cil-user c-sidebar-nav-icon"></i>
            {{ trans('lang.User') }}
        </a>
    </li>
    <!-- <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/service-provider/list') }}">
            <i class="fa fa-cubes c-sidebar-nav-icon"></i>
            {{ trans('lang.Service_Provider') }}
        </a>
    </li> -->
    <!-- <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/country-list') }}">
            <i class="fa fa-flag c-sidebar-nav-icon"></i>
            {{ trans('lang.master_category') }}
        </a>
    </li> -->
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/category-list') }}">
            <i class="fa fa-list-alt c-sidebar-nav-icon"></i>
            {{ trans('lang.master_category') }}
        </a>
    </li>
     <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/contact-us') }}">
            <i class="fa fa-address-card c-sidebar-nav-icon"></i>
            {{ trans('lang.Contact_US') }}
        </a>
    </li>
     <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/about-us') }}">
            <i class="fa fa-info c-sidebar-nav-icon"></i>
            {{ trans('lang.About_US') }}
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/privacy-policy') }}">
            <i class="fa fa-shield c-sidebar-nav-icon"></i>
            {{ trans('lang.Privacy_Policy') }} 
        </a>
    </li>
     <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/trems') }}">
            <i class="fa fa-gavel c-sidebar-nav-icon"></i>
            {{ trans('lang.Terms_and_Conditions') }} 
        </a>
    </li> 
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{ url('admin/notification') }}">
            <i class="fa fa-bell c-sidebar-nav-icon"></i>
            {{ trans('lang.notification') }} 
        </a>
    </li>
    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></ul>
<button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
