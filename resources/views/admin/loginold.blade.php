<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in | My Dancediary</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="{{ url('/')}}/public/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="{{ url('/')}}/public/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="{{ url('/')}}/public/admin/css/themes.css" rel="stylesheet" type="text/css" />
        <!-- FOR TOASTER -->
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/public/admin/css/main.css">
        <link rel="stylesheet" type="text/css" href="{{ url('/')}}/public/admin/css/toastr.min.css">
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
    <body class="bg-black">

        <!-- @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif

        @if(session('status_err'))
          <div class="alert alert-danger">
                {{ session('status_err') }}
          </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif -->

        <div class="form-box" id="login-box">
            <div class="header">My Dancediary <h3>Sign In</h3> </div>

            <form id="myform" method="post" action="{{ url('admin/login') }}">
                 @csrf
                <div class="body bg-gray">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Username" name="email" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Password" name="password" >
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>


            <!-- jQuery UI 1.10.3 -->
            <script src="http://mydancediary.com/dancediary/public/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ url('/')}}/public/admin/js/bootstrap.min.js" type="text/javascript"></script>

        <!--Toaster-->
        <script type="text/javascript" src="{{ url('/')}}/public/admin/js/toastr.min.js"></script>
        <script type="text/javascript" src="{{ url('/')}}/public/admin/js/toastr.min.js"></script>
        <!-- validation -->
        <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>

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
        <script type="text/javascript">
            $(document).ready(function() {

                $("#myform").validate({
                    rules: { email: {
                                        required: true,
                                        email: true,
                                    },
                             password:{
                                    required : true,
                             },
                            },
                    messages: {
                                email: "Please Enter vailid Email address",
                                password: "Please Enter Password"
                            },


                });
            });
        </script>
    </body>
</html>
