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
                    <a href="{{ url('admin/add-yacht-category') }}" class="btn btn-primary pull-right" style="margin-bottom:8px">{{ trans('lang.AddYachtCategory') }}</a>
                </div>
            </div>

              <div class="card-body">
                  <table class="table table-responsive-sm table-striped">
                  <thead>
                    <tr>
                        <th>{{ trans('lang.S_No') }}</th>
                        <th>{{ trans('lang.Yach tCategory Name English') }}</th>
                        <th>{{ trans('lang.YachtCategoryName Arabic') }}</th>
                        <th>{{ trans('lang.YachtCategoryimage') }}</th>
                        <th width="140px">{{ trans('lang.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                                            @foreach($data as $value)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><img width="50" height="50" src="{{ $value->image }}" ></td>
                                                    <td>{{$value->categoryName}}</td>
                                                    <td>{{$value->categoryNameAr}}</td>
                                                    <td>

                                                        <a title="View" href="{{url('/admin/edit-yacht-category/'.encrypt($value->id))}}" class="btn btn-info btn btn-sm">
                                                        <i class="fa  fa-edit" aria-hidden="true"></i></a>

                                                        <a title="Delete" href="{{url('/admin/delete-yacht-category/'.encrypt($value->id))}}" onclick="return myFunction()" class="btn btn-danger btn btn-sm delete_user">
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
@endsection

@section('javascript')

  <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
