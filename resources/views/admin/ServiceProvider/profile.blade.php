@extends('admin.base')
@section('content')
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> {{ trans('lang.User_Profile') }}</div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <img class="mx-auto d-block img-thumbnail" src="{{ $data->image }}" width="300px" height="300px">
                                </div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b> {{ trans('lang.lastName') }} : </b></label>
                                            <div class="col-sm-8 col-form-label p_0">
                                                <span>{{ ucfirst($data->firstName) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.lastName') }} : </b></label>
                                            <div class="col-sm-8 col-form-label p_0">
                                                <span>{{ ucfirst($data->lastName) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.MobileNo') }} : </b></label>
                                            <div class="col-sm-8 col-form-label p_0">
                                                <span>{{ $data->mobileNo }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.License image') }} : </b></label>
                                            <div class="col-sm-8 col-form-label p_0">
                                                <img class="mx-auto d-block img-thumbnail" src="{{ $data->license_image }}" width="300px" height="300px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                      <i class="fa fa-align-justify"></i> {{ $yacht_list_title }}</div>
                                    <div class="card-body">
                                        <table id='userTable' class="table table-responsive-sm table-striped">
                                        <thead>
                                          <tr>
                                              <th>{{ trans('lang.S_No') }}</th>
                                              <th>{{ trans('lang.YachtName') }}</th>
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
                    <div class="card-footer">
                        <a href="{{ route('user.list') }}" class="btn btn-sm btn-primary pull-right" >{{ __('Return') }}</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' />
        <script src="{{ url('/')}}/public/assets/datatables_cdn/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
        <script type="text/javascript">
            $(function () {
        
              var table = $('#userTable').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ url('/admin/service-provider-profile') . '/' . encrypt($data->id) }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                      {data: 'yachtName', name: 'yachtName'},
                      {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
              });
        
            });
          </script>
@endsection


@section('javascript')

@endsection
