<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta property="og:title" content="Verify Your Email">
  <title>Reset Password</title>
    <link href="https://parsleyjs.org/src/parsley.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script> -->

  <script src="{{ asset('parsley.js') }}"></script>

      <style type="text/css">
         .parsley-errors-list {
         list-style-type: none;
         padding-left: 0;
         color: #ff0000;
         }
      </style>

  <style type="text/css">
    #outlook a{
        padding:0;
      }
      body{
        width:100% !important;
      }
      .ReadMsgBody{
        width:100%;
      }
      .ExternalClass{
        width:100%;
      }
      body{
        -webkit-text-size-adjust:none;
      }
      body{
        margin:0;
        padding:0;
      }
      img{
        border:0;
        height:auto;
        line-height:100%;
        outline:none;
        text-decoration:none;
      }
      table td{
        border-collapse:collapse;
      }
      #backgroundTable{
        height:100% !important;
        margin:0;
        padding:0;
        width:100% !important;
      }
    
      body,#backgroundTable{
       background-color:#FAFAFA;
      }
   
      #templateContainer{
        border:1px none #DDDDDD;
      }
  
      h1,.h1{
        color:#202020;
        display:block;
        font-family:Arial;
       font-size:24px;
        font-weight:bold;
        line-height:100%;
        margin-top:20px;
        margin-right:0;
        margin-bottom:20px;
        margin-left:0;
       text-align:center;
      }
   
      h2,.h2{
        color:#202020;
        display:block;
        font-family:Arial;
        font-size:30px;
       font-weight:bold;
        line-height:100%;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
       text-align:center;
      }
   
      h3,.h3{
        color:#202020;
        display:block;
        font-family:Arial;
        font-size:26px;
        font-weight:bold;
        line-height:100%;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
        text-align:center;
      }
    
      h4,.h4{
        color:#202020;
        display:block;
        font-family:Arial;
        font-size:22px;
        font-weight:bold;
        line-height:100%;
        margin-top:0;
        margin-right:0;
        margin-bottom:10px;
        margin-left:0;
        text-align:center;
      }
    
      #templatePreheader{
        background-color:#FAFAFA;
      }
    
      .preheaderContent div{
       color:#505050;
       font-family:Arial;
        font-size:10px;
        line-height:100%;
        text-align:left;
      }
    
      .preheaderContent div a:link,.preheaderContent div a:visited,.preheaderContent div a .yshortcuts {
        color:#336699;
        font-weight:normal;
        text-decoration:underline;
      }
      .preheaderContent img{
        display:inline;
        height:auto;
        margin-bottom:10px;
        max-width:280px;
      }
   
      #templateHeader{
      background-color:#FFFFFF;
        border-bottom:0;
      }
    
      .headerContent{
       color:#202020;
        font-family:Arial;
       font-size:34px;
        font-weight:bold;
       line-height:100%;
       padding:0;
        text-align:left;
        vertical-align:middle;
        background-color: #FAFAFA;
          padding-bottom: 14px;
      }
 
      .headerContent a:link,.headerContent a:visited,.headerContent a .yshortcuts {
        color:#336699;
        font-weight:normal;
        text-decoration:underline;
      }
      #headerImage{
        height:auto;
        max-width:400px !important;
      }

      #templateContainer,.bodyContent{
       background-color:#FFFFFF;
      }
 
      .bodyContent div{
      color:#505050;
       font-family:Arial;
      font-size:14px;
     line-height:150%;
      text-align:left;
      }
  
 
      .bodyContent div a:link,.bodyContent div a:visited,.bodyContent div a .yshortcuts {
        color:#336699;
        font-weight:normal;
       text-decoration:underline;
      }
      .bodyContent img{
        display:inline;
        height:auto;
        margin-bottom:10px;
        max-width:280px;
      }

      #templateFooter{
        background-color:#FFFFFF;
        border-top:0;
      }
 
      .footerContent {
        background-color: #fafafa;
      }
      .footerContent div{
       color:#707070;
       font-family:Arial;
        font-size:11px;
        line-height:150%;
       text-align:left;
      }
  
      .footerContent div a:link,.footerContent div a:visited,.footerContent div a .yshortcuts {
        color:#336699;
        font-weight:normal;
      text-decoration:underline;
      }
      .footerContent img{
        display:inline;
      }
   
      #social{
        background-color:#FAFAFA;
        border:0;
      }
  
      #social div{
       text-align:left;
      }
  
      #utility{
        background-color:#FFFFFF;
        border:0;
      }

      #utility div{
        text-align:left;
      }
      #monkeyRewards img{
        display:inline;
        height:auto;
        max-width:280px;
      }
  
  
   
  
    .buttonText {
      color: #4A90E2;
      text-decoration: none;
      font-weight: normal;
      display: block;
      border: 2px solid #585858;
      padding: 10px 80px;
      font-family: Arial;
    }
  
    #supportSection, .supportContent {
      background-color: white;
      font-family: arial;
      font-size: 12px;
      border-top: 1px solid #e4e4e4;
    }
  
    .bodyContent table {
      padding-bottom: 10px;
    }
  
  
    .footerContent p {
      margin: 0;
      margin-top: 2px;
    }
  
    .headerContent.centeredWithBackground {
      background-color: #F4EEE2;
      text-align: center;
      padding-top: 20px;
      padding-bottom: 20px;
    }
        
     @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            h1 {
                font-size: 40px !important;
            }
            
            .content {
                font-size: 22px !important;
            }
            
            .bodyContent p {
                font-size: 22px !important;
            }
            
            .buttonText {
                font-size: 22px !important;
            }
            
            p {
                
                font-size: 16px !important;
                
            }
            
            .footerContent p {
                padding-left: 5px !important;
            }
            
            .mainContainer {
                padding-bottom: 0 !important;   
            }
        }
  </style>
  
</head>

<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="width:100% ;-webkit-text-size-adjust:none;margin:0;padding:0;background-color:#FAFAFA;">
  <center>
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="height:100% ;margin:0;padding:0;width:100% ;background-color:#FAFAFA;">
      <tr>
        <td align="center" valign="top" style="border-collapse:collapse;">
          
          <table border="0" cellpadding="10" cellspacing="0" width="450" id="templatePreheader" style="background-color:#FAFAFA;">
            <tr>
              <td valign="top" class="preheaderContent" style="border-collapse:collapse;">
                
                <table border="0" cellpadding="10" cellspacing="0" width="100%">
                  <tr>
                    <td valign="top" style="border-collapse:collapse;">
                     
                    </td>
                  </tr>
                </table>
                
              </td>
            </tr>
          </table>
         
          <table border="0" cellpadding="0" cellspacing="0" width="450" id="templateContainer" style="border:1px none #DDDDDD;background-color:#FFFFFF;">
            <tr>
              <td align="center" valign="top" style="border-collapse:collapse;">
                
                <table border="0" cellpadding="0" cellspacing="0" width="450" id="templateHeader" style="border-bottom:0;">
                  <tr>
                    <td class="headerContent centeredWithBackground" style="border-collapse:collapse;color:#202020;font-family:Arial;font-size:34px;font-weight:bold;line-height:100%;padding:0;text-align:center;vertical-align:middle;padding-bottom:20px;padding-top:20px;">
                        <h2>Reset Password</h2>
                    </td>
                  </tr>
                </table>
               
              </td>
            </tr>
            <tr>
              <td align="center" valign="top" style="border-collapse:collapse;">
                
                <table border="0" cellpadding="0" cellspacing="0" width="450" id="templateBody">
                  <tr>
                    <td valign="top" class="bodyContent" style="border-collapse:collapse;background-color:#FFFFFF;">
                     
                      <table border="0" cellpadding="20" cellspacing="0" width="100%" style="padding-bottom:10px;">

                        <p style="color: #666; font-size: 18px; text-align: left;">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if(session('status_err'))
                                <div class="alert alert-danger">
                                    {{ session('status_err') }}
                                </div>
                            @endif
                         </p>
                        <!-- <tr>
                          <td valign="top" style="padding-bottom:1rem;border-collapse:collapse;" class="mainContainer">
                            <div style="text-align:center;color:#505050;font-family:Arial;font-size:14px;line-height:150%;">
                              <p>Please verify your <b>Truck Yaah</b> account by clicking the link </p>
                            </div>
                          </td>
                        </tr> -->
                        <tr>
                          <td align="center" style="border-collapse:collapse;">
                            <form style="margin: 50px 0;" method="post" action="{{ url('reset_password')}}" data-parsley-validate>
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ app('request')->input('id')}}">
                        <input type="Password" name="new_password" id="new_password" placeholder="New Password" style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #ccc;outline: none;width: 80%;margin: 0 auto 20px;" required data-parsley-required data-parsley-required-message="Please Enter New Password">
                        @if ($errors->has('new_password'))
                        <div class="alert-danger">
                           {{ $errors->first('new_password') }}
                        </div>
                        @endif
                        <input type="Password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #ccc;outline: none;width: 80%;margin: 0 auto 20px;" required data-parsley-required data-parsley-required-message="Please Enter Confirm Password" data-parsley-equalto="#new_password" data-parsley-equalto-message="Password and Confirm password must be same">
                        @if ($errors->has('confirm_password'))
                        <div class="alert-danger">
                           {{ $errors->first('confirm_password') }}
                        </div>
                        @endif
                        <input type="submit" value="submit" style="width: 63%;display: block;height: 40px;text-transform: uppercase;margin: 0 auto;border-radius: 50px;border: 2px solid #00afa9;background: transparent;outline: none;text-align: center;color: #333;font-weight: 600;cursor: pointer;">
                     </form>
                          </td>
                        </tr>
                      </table>
                     
                      Thanks and Regard <br>
                      Truck Yaah Team
                    </td>
                  </tr>
                </table>
              
              </td>
            </tr>
            <tr>
              <td align="center" valign="top" style="border-collapse:collapse;">
              
                <table border="0" cellpadding="10" cellspacing="0" width="450" id="supportSection" style="background-color:white;font-family:arial;font-size:12px;border-top:1px solid #e4e4e4;">
                  <tr>
                    <td valign="top" class="supportContent" style="border-collapse:collapse;background-color:white;font-family:arial;font-size:12px;border-top:1px solid #e4e4e4;">
                      
                      <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                          <td valign="top" width="100%" style="border-collapse:collapse;">
                            <br>
                            <div style="text-align: center; color: #c9c9c9;">
                              <p>Truck Yaah : &nbsp;
                                <a href="javascript:void(0)" style="color:#4a90e2;font-weight:normal;text-decoration:underline; font-size: 12px;">Help Center</a>.</p>
                            </div>
                            <br>
                          </td>
                        </tr>
                      </table>
                      
                    </td>
                  </tr>
                </table>
                
              </td>
            </tr>
            <tr>
              <td align="center" valign="top" style="border-collapse:collapse;">
                
                <table border="0" cellpadding="10" cellspacing="0" width="450" id="templateFooter" style="background-color:#FFFFFF;border-top:0;">
                  <tr>
                    <td valign="top" class="footerContent" style="padding-left:0;border-collapse:collapse;background-color:#fafafa;">
                      <div style="text-align:center;color:#c9c9c9;font-family:Arial;font-size:11px;line-height:150%;">
                        <p style="text-align:left;margin:0;margin-top:2px;">Truck Yaah | Brooklyn, New York, 11201 | Copyright © 2020 | All rights reserved</p>
                      </div>
                      
                    </td>
                  </tr>
                </table>
               
              </td>
            </tr>
          </table>
          <br>
        </td>
      </tr>
    </table>
  </center>
</body>
    
     

    <script type="text/javascript" src="{{ url('/')}}/parsley.js"></script>
   <script type="text/javascript" src="{{ url('/')}}/parsley.min.js"></script>

</html>

<script type="text/javascript">
    $('.alert-danger').delay(7000).fadeOut();    
    $('.alert').delay(5000).fadeOut();  

</script>