<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard | {{ trans('lang.my_dancediary') }}</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        @yield('styles')
        <!-- bootstrap 3.0.2 -->
        <link href="{{ url('/')}}/public//admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ url('/')}}/public//admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ url('/')}}/public//admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="{{ url('/')}}/public//admin/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="{{ url('/')}}/public//admin/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="{{ url('/')}}/public//admin/css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="{{ url('/')}}/public//admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="{{ url('/')}}/public//admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="{{ url('/')}}/public//admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ url('/')}}/public//admin/css/themes.css" rel="stylesheet" type="text/css" />
        <!-- FOR TOASTER -->
        <!-- <link rel="stylesheet" type="text/css" href="{{ url('/')}}/public//admin/css/main.css"> -->
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/public//admin/css/toastr.min.css">
        <style type="text/css">
            .toast-message{ color:white; } 
            .toast-success{ background:green; } 
            .toast-danger{ background:red; } 
            .toast-error{ background:red; }
        </style>
        <style type="text/css">
            form .error{
                color:red;    
            }
        </style>
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                {{ trans('lang.my_dancediary') }}
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>{{ trans('lang.admin') }} <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="{{ url('/')}}/public//admin/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>Admin - {{ trans('lang.my_dancediary') }}</p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                       <!--  <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                    </div>
                                    <div class="pull-right">
                                        
                                        <a class="btn btn-default btn-flat" href="{{ route('admin_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> {{ trans('lang.sign_out') }} </a>
                                        <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
                                        @csrf
                                        </form>

                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ url('/')}}/public//admin/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>{{ trans('lang.admin') }}</p>

                            <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="{{ url('admin/admin_dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span>{{ trans('lang.dashboard') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/admin/user/list')}}">
                                <i class="fa fa-list-ol"></i> <span>{{ trans('lang.user') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/admin/event-list')}}">
                                <i class="fa fa-dot-circle-o"></i> <span>{{ trans('lang.events') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('/admin/competition-list')}}">
                                <i class="fa fa-dot-circle-o"></i> <span>{{ trans('lang.competitions') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-video-camera"></i> <span>{{ trans('lang.genre') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('admin/tips-list') }}">
                                <i class="fa fa-table"></i> <span>{{ trans('lang.tip') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>{{ trans('lang.quiz') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-list-alt"></i> <span>{{ trans('lang.review') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('admin/product-list') }}">
                                <i class="fa fa-book"></i> <span>{{ trans('lang.news_product') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ url('admin/contact-us') }}">
                                <i class="fa fa-book"></i> <span>{{ trans('lang.contact_us') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="fa fa-circle"></i> <span>Master</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <!-- <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Users</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a> -->
                            <!-- <ul class="treeview-menu">
                                <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                                <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                                <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                            </ul> -->
                        </li>
                        
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
            @yield('content')    
            <!-- jQuery 2.0.2 -->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
            <!-- jQuery UI 1.10.3 -->
            <!-- <script src="{{ url('/')}}/public//admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script> -->
            <!-- Bootstrap -->
            <script src="{{ url('/')}}/public//admin/js/bootstrap.min.js" type="text/javascript"></script>
            <!-- Morris.js charts -->
            <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
            <script src="{{ url('/')}}/public//admin/js/plugins/morris/morris.min.js" type="text/javascript"></script>
            <!-- Sparkline -->
            <script src="{{ url('/')}}/public//admin/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
            <!-- jvectormap -->
            <script src="{{ url('/')}}/public//admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
            <script src="{{ url('/')}}/public//admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
            <!-- fullCalendar -->
            <script src="{{ url('/')}}/public//admin/js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
            <!-- jQuery Knob Chart -->
            <script src="{{ url('/')}}/public//admin/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
            <!-- daterangepicker -->
            <script src="{{ url('/')}}/public//admin/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
            <!-- Bootstrap WYSIHTML5 -->
            <script src="{{ url('/')}}/public//admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
            <!-- iCheck -->
            <script src="{{ url('/')}}/public//admin/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

            <!-- dashboard demo (This is only for demo purposes) -->
            <script src="{{ url('/')}}/public//admin/js/AdminLTE/dashboard.js" type="text/javascript"></script> 
            <!-- DATA TABES SCRIPT -->
            <script src="{{ url('/')}}/public//admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
            <script src="{{ url('/')}}/public//admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
            <!-- Admin App -->
            <script src="{{ url('/')}}/public//admin/js/AdminLTE/app.js" type="text/javascript"></script>
            <!--Toaster-->
            <script type="text/javascript" src="{{ url('/')}}/public//admin/js/toastr.min.js"></script>
            @yield('script')
            <script type="text/javascript">
              $('.alert-danger').delay(7000).fadeOut();    
              $('.alert').delay(5000).fadeOut();  

              @if(session()->has('status'))
                     toastr.success("{{ session('status') }}");
              @endif

              @if(session()->has('status_err'))
                  toastr.error("{{ session('status_err') }}");
              @endif
            </script>  
    </body>
</html>