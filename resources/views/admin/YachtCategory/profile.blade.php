@extends('admin.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i> User {{ $data->name }}</div>
                    <div class="card-body">
                        <img src="{{ $data->image }}" alt="..." class='margin' width="180px" height="110px" />
                        <h4>Name: {{ $data->name }}</h4>
                        <h4>E-mail: {{ $data->email }}</h4>
                        <a href="{{ route('user.list') }}" class="btn btn-block btn-primary">{{ __('Return') }}</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')

@endsection
