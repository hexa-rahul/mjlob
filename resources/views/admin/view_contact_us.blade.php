@extends('admin.base')

@section('content')

<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> {{ trans('lang.view_contactus') }}</div>
            <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.name') }} : </b></label>
                                    <div class="col-sm-8 col-form-label p_0">
                                        <span>{{ ucfirst($data->name) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.email') }} : </b></label>
                                    <div class="col-sm-8 col-form-label p_0">
                                        <span>{{ ucfirst($data->email) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.note') }} : </b></label>
                                    <div class="col-sm-8 col-form-label p_0">
                                        <span>{{ ucfirst($data->note) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <a href="{{ url('admin/contact-us') }}" class="btn btn-sm btn-primary pull-right" >{{ __('Return') }}</a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('javascript')

@endsection
