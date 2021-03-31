@extends('admin.authBase')
@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <div class="card-body">
                <h1>{{ trans('lang.login') }} </h1>
                <p class="text-muted">{{ trans('lang.sign_in_to_your_account') }}</p>
                <form method="POST" action="{{ url('admin/login') }}">
                    @csrf
                    <div class="input-group mb-3">
                    @error('email')
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                    <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}"  autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-key"></i>
                        </span>
                    </div>
                    <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="row">
                    <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                    </div>
                    </form>
                    {{-- <div class="col-6 text-right">
                        <a href="{{ route('password.request') }}" class="btn btn-link px-0" type="button">{{ __('Forgot Your Password?') }}</a>
                    </div> --}}
                    </div>
                </div>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>{{ trans('lang.admin') }} {{ trans('lang.login') }}</h2>
                  <p>{{ trans('lang.You_can_manage_application_after_login') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('javascript')
@endsection
