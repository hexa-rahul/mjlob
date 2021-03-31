<!doctype html>
<html class="no-js" lang="en-US">


<!-- Mirrored from daarapp.co/frontend by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2020 15:53:16 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('lang.project_name') }}</title>

    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel='stylesheet' id='apparktools-style-css' href='{{ asset('public/fassets/frontend/css/icons.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='owl-carousel-css' href='{{ asset('public/fassets/frontend/css/owl-carousel-min.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='owl-theme-css' href='{{ asset('public/fassets/frontend/css/owl.theme.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='apparktools-style-css' href='{{ asset('public/fassets/frontend/css/tools.css')}}' type='text/css' media='all' />

    <link rel='stylesheet' id='appark-fonts-css' href='http://fonts.googleapis.com/css?family=Poppins%3A300%2C400%2C500%2C600%2C700&amp;subset=latin%2Clatin-ext' type='text/css' media='all' />
    <link rel='stylesheet' id='icofont-css' href='{{ asset('public/fassets/frontend/css/icofont-min.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='bootstrap-css' href='{{ asset('public/fassets/frontend/css/bootstrap-min.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='slicknav-css' href='{{ asset('public/fassets/frontend/css/slicknav.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='appark-theme-css' href='{{ asset('public/fassets/frontend/css/theme.css')}}' type='text/css' media='all' />

    <link rel='stylesheet' id='normalizer-css' href='{{ asset('public/fassets/frontend/css/normalize.css')}}' type='text/css' media='all' />

    <link rel='stylesheet' id='appark-responsive-css' href='{{ asset('public/fassets/frontend/css/responsive.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='kc-general-css' href='{{ asset('public/fassets/frontend/css/kingcomposer.min.css')}}' type='text/css' media='all' />
    <link rel='stylesheet' id='kc-animate-css' href='{{ asset('public/fassets/frontend/css/animate.css')}}' type='text/css' media='all' />
    <script type='text/javascript' src='{{ asset('public/fassets/frontend/js/jquery.js')}}'></script>
    <style>
        .error{
            color:red:
            font-size:12px;
        }
    </style>
</head>
<body class="page-template-default page page-id-734 theme-appark kingcomposer kc-css-system transparent-menu header-remove" data-spy="scroll" data-target=".mainmenu-area">



      @include('website.header')

      <div class=" page-contents">

          @yield('content')

        </main>
        @include('website.footer')
        <script>

            /* function save()
             {
                 alert("Hello");
                 $('#reset_form').validate({
                     rules:{
                         password:{
                             required:true,
                             min_length:5
                         },
                         password_confirm:{
                             required:true,
                             min_length:5,
                             equalTo:['#password']
                         }
                     },
                     messages:{
                         password:{
                             required:"Password Field is Required",
                             min_length:"Lenght must be more than 5 character"
                         },
                         password_confirm:{
                             required:"Password Field is Required",
                             min_length:"Lenght must be more than 5 character",
                             equalTo:"Password must be same as Confirm Password"
                         }
                     }
                 });
             }*/


             /*jQuery('#validatedForm').validate({
                 rules : {
                     password : {
                         minlength : 5
                     },
                     password_confirm : {
                         minlength : 5,
                         equalTo : '[name="password"]'
                     }
                    }
             });*/
          </script>

         </body>


         <!-- Mirrored from daarapp.co/frontend by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Aug 2020 15:53:16 GMT -->
         </html>
