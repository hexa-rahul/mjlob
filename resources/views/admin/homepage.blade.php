@extends('admin.base')

@section('content')

          <div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-primary">
                    <div class="card-body pb-0">
                      <div class="btn-group float-right">
                        {{-- <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> --}}
                        <button class="btn btn-transparent  p-0" type="button" >
                            <i class="fa  fa-users" aria-hidden="true"></i>
                        </button>
                        {{-- <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div> --}}
                      </div>
                      <div class="text-value-lg">{{ $TOTAL_USER}}</div>
                      <div>{{ trans('lang.total_user') }}</div>
                    </div>
                    
                  </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                  <div class="card text-white bg-info">
                    <div class="card-body pb-0">
                      <button class="btn btn-transparent p-0 float-right" type="button">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                      </button>
                      <div class="text-value-lg">{{ $total_category}}</div>
                      <div>{{ trans('lang.total_category') }}</div>
                    </div>
                    
                  </div>
                </div>
                <!-- /.col-->


                <!-- /.col-->
              </div>

              <!-- /.row-->
            </div>
          </div>

@endsection

@section('javascript')

  <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
@endsection
