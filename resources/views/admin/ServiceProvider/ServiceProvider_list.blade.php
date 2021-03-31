@extends('admin.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }}</div>
              <div class="card-body">
                  <table id='userTable' class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('lang.S_No') }}</th>
                        <th>{{ trans('lang.Profile') }}</th>
                        <th>{{ trans('lang.First_Name') }} </th>
                        <th>{{ trans('lang.lastName') }}</th>
                        <th>{{ trans('lang.MobileNo') }}</th>
                        <th>{{ trans('lang.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
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
  <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' />
<script src="{{ url('/')}}/public/assets/datatables_cdn/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
<script type="text/javascript">
    $(function () {

      var table = $('#userTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('service_provider.list') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
              {data: 'profile_pic', name: 'profile_pic',orderable: false, searchable: false},
              {data: 'firstName', name: 'firstName'},
              {data: 'lastName', name: 'lastName'},
              {data: 'mobileNo', name: 'mobileNo'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });

    });
  </script>
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
    {{-- <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script> --}}
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
