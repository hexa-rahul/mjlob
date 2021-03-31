@extends('admin.base')

@section('content')

<div class="container-fluid">
<!-- Select2 CSS --> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
<!-- Select2 JS --> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<div id='result'></div>
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id='myform' action="{{ url('admin/notification') }}" method="post" role="form" enctype="multipart/form-data" >
          <div class="card">

              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }}</div>
              <div class="card-body">
                    {{ csrf_field() }}
                    
                            <div class="row">
                              <div class="col-12">
                                @if(Session::has('flash_message'))
        <div class="alert alert-success">
          <button type="button" class="close" data-dismiss="alert">×</button>
            {{ Session::get('flash_message') }}
        </div>

        @endif
        <?php session()->forget('flash_message'); ?>

                                  <div class="form-group">
                                      <label>{{ trans('lang.notification_to') }}</label>
                                      <select name="notification_to" id='selUser' class="form-control">
                                        <option value="alluser">All user</option>
                                        <!-- <option value="all_services_provider">All Services provider</option> -->
                                        @foreach ($userdata as $user){
                                        <option value="{{ $user->id }}">{{ $user->firstName }} {{ $user->username }}</option>
                                        }
                                            
                                        @endforeach
                                        
                                      </select>
                                  </div>
                                  <div class="form-group">
                                      <label>{{ trans('lang.notification_message') }}</label>
                                      <textarea class="form-control" name="notification_message" id="notification_message" cols="30" rows="10" placeholder="{{ trans('lang.notification_message') }}"></textarea>
                                      
                                  </div>

                              </div>
                          </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-primary pull-right" type="submit"> {{ trans('lang.submit') }}</button>
                {{-- <button class="btn btn-sm btn-danger" type="reset"> Reset</button> --}}
              </div>

          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  
  <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
  <script type="text/javascript">
  CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('editor1');

  </script>
  <script type="text/javascript">
    $(document).ready(function(){
 
  // Initialize select2
  $("#selUser").select2();

  // Read selected option
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();

    $('#result').html("id : " + userid + ", name : " + username);

  });
});
  </script>


@endsection

