@extends('admin.base')

@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ trans('lang.user_profile') }}</div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <img class="mx-auto d-block img-thumbnail" onerror="this.src='{{ asset('/public/uploads/user-profile/default.png') }}'" src="{{ $data->image }}" width="300px" height="300px">
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.username') }} : </b></label>
                                    <div class="col-sm-8 col-form-label p_0">
                                        <span>{{ ucfirst($data->username) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.mobile_no') }} : </b></label>
                                    <div class="col-sm-8 col-form-label p_0">
                                        <span>{{ ucfirst($data->mobile_number) }}</span>
                                    </div>
                                </div>
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

@endsection


@section('javascript')

@endsection
