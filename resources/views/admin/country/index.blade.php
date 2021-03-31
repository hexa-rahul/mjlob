@extends('admin.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }}
                <div class="card-header-actions">
                    <a href="{{ url('admin/add-country') }}" class="btn btn-primary pull-right" style="margin-bottom:8px">{{ trans('lang.AddCountry') }}</a>
                </div>
            </div>

              <div class="card-body">
             
                                
                        
              @if (Session::has('status'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('status') }}</strong>
                                </div>
                            @endif
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('lang.S_No') }}</th>
                        <th>{{ trans('lang.Countryimage') }} </th>
                        <th>{{ trans('lang.CountryName') }}</th>
                        <th>{{ trans('lang.CountryName') }}</th>
                        <th>{{ trans('lang.Position') }}</th>
                        <th width="140px">{{ trans('lang.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                                            @foreach($data as $value)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><img width="50" height="50" src="{{ $value->image }}" ></td>
                                                    <td>{{$value->countryName}}</td>
                                                    <td>{{$value->countryNameAr}}</td>
                                                    <td>{{$value->position}}</td>
                                                    <td>

                                                        <a title="View" href="{{url('/admin/edit-country/'.encrypt($value->id))}}" class="btn btn-info btn btn-sm">
                                                        <i class="fa  fa-edit" aria-hidden="true"></i></a>

                                                        <a title="Delete" href="{{url('/admin/delete_country/'.encrypt($value->id))}}" onclick="return myFunction()" class="btn btn-danger btn btn-sm delete_user">
                                                           <i class="fa  fa-trash-o" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="{{ url('/')}}/admin/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- page script -->
  <script type="text/javascript">
      $(function() {
          $("#example1").dataTable();
          $('#example2').dataTable({
              "bPaginate": true,
              "bLengthChange": false,
              "bFilter": false,
              "bSort": true,
              "bInfo": true,
              "bAutoWidth": false
          });
      });
  </script>
  <script>
      $('.delete_user').click(function(){
      var checkstr =  confirm('are you sure you want to delete this?');
      if(checkstr == true){
        // do your code
      }else{
      return false;
      }
      });
  </script>
  <script>
      function change_status(id,value)
      {
          var user_id = id;
          if(confirm("Are you sure want "+value+" this user")){
              $.ajax({
                  url: "{{ url('admin/user/status/') }}/"+user_id,
                  dataType: 'json',
                  cache: false,
                  contentType: false,
                  processData: false,
                  type: 'get',
                  success: function(response) {
                      console.log(response);
                      var data = response;
                      if(data.status == 1)
                      {
                          $('#change_status_'+data.user_id).removeClass("btn-primary").addClass('btn-success').text('Active')
                      }
                      else
                      {

                          $('#change_status_'+data.user_id).removeClass("btn-success").addClass('btn-primary').text('Inactive')
                      }
                      location.reload();
                  }
              });
          }
      }
  </script>
@endsection

@section('javascript')

  <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
