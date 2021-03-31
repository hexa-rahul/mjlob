@extends('admin.base')
@section('content')
  <div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card">
              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }} <?php if(!empty($masterCategory)){ ?><small style="color: #213d6b;font-size: x-small;font-weight: 900;"><?php echo "-".($masterCategory)?$masterCategory:'' ?></small><?php } ?>
                <!-- <div class="card-header-actions">
                  <a href="{{ url('admin/add-yacht-category') }}" class="btn btn-primary pull-right" style="margin-bottom:8px">{{ trans('lang.add_master_category') }}</a>
                </div> -->
              </div>
              <div class="card-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                        <th>{{ trans('lang.s_no') }}</th>
                        <th>{{ trans('lang.category_english') }}</th>
                        <th>{{ trans('lang.category_arabic') }}</th>
                        <th width="140px">{{ trans('lang.action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @foreach($data as $value)
                      <tr>
                        <td>{{$i}}</td>
                        <td>@if($value->is_sub_category_exist==1) 
                            <a href="{{ url('/admin/category-list/'.encrypt($value->id)) }}">{{$value->name}}</a>
                            @else
                            {{$value->name}}
                            @endif
                        </td>
                        <td>{{$value->name_ar}}</td>
                        <td>
                          <a title="View" href="{{url('/admin/edit-category/'.encrypt($value->id))}}" class="btn btn-info btn btn-sm">
                            <i class="fa  fa-edit" aria-hidden="true"></i>
                          </a>
                         <!--  <a title="Delete" href="{{url('/admin/delete-yacht-category/'.encrypt($value->id))}}" onclick="return myFunction()" class="btn btn-danger btn btn-sm delete_user">
                            <i class="fa  fa-trash-o" aria-hidden="true"></i>
                          </a> -->
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
    <!-- page script -->
    <script>
        $('.delete_user').click(function(){
        var checkstr =  confirm('Are you sure you want to delete this?');
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
