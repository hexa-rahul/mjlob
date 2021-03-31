@extends('admin.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }}
                
            </div>

              <div class="card-body">
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('lang.s_no') }}</th>
                        <!--  <th>{{ trans('lang.name') }}</th> -->
                        <th>{{ trans('lang.mobile_no') }}</th>
                        <th>{{ trans('lang.note') }}</th>
                        <th width="140px">{{ trans('lang.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                   @php $i=1; @endphp
                    @foreach($data as $value)
                        <tr>
                            <td>{{$i}}</td>
                            <!-- <td>{{ $value->name }}</td> -->
                            <td>{{ $value->mobile_number }}</td>
                            <td>{{ $value->message }}</td>
                            <td>
                                <a title="View" href="{{url('/admin/view-contact-us/'.encrypt($value->id))}}" class="btn btn-info btn btn-sm">
                                <i class="fa  fa-eye" aria-hidden="true"></i></a>
                                <a title="Delete" href="{{url('/admin/contact/delete/'.encrypt($value->id))}}" onclick="return myFunction()" class="btn btn-danger btn btn-sm delete_user">
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
          $("#example4").dataTable();
          $('#example4').dataTable({
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
@endsection

@section('javascript')

  <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
