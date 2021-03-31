@extends('admin.base')

@section('content')

    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $title }}</h4>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                    </div>
                                </div>
                            @endif

                            <form id='myform' action="{{ url('admin/add-country') }}" method="post" role="form"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ trans('lang.Country Name English') }}</label>
                                            <input type="text" id="countryName" name="countryName"
                                                placeholder="{{ trans('lang.Country Name English') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('lang.Country Name Arabic') }}</label>
                                            <input type="text" id="countryNameAr" name="countryNameAr"
                                                placeholder="{{ trans('lang.Country Name Arabic') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('lang.Position') }}</label>
                                            <input type="number" id="position" name="position"
                                                placeholder="{{ trans('lang.Position') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Image">{{ trans('lang.Countryimage') }} </label>
                                            <input type="file" name="image" class="form-control" id="image"
                                                placeholder="Image" style="width: auto">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right"
                                            style="margin-right: -14px;"> {{ trans('lang.submit') }}  </button>
                                        <br>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('javascript')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- validation -->
    <script src="http://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $("#myform").validate({
                rules: {
                    countryName: {
                        required: true,
                    },
                    // image: {
                    //     required: true,
                    // },
                    position: {
                        required: true,
                    },
                    countryNameAr: {
                        required: true,
                    },
                },
                messages: {
                    countryName: "{{ trans('Please Enter Country Name') }}",
                    countryNameAr: "{{ trans('Please Enter Country Name') }}",
                    position: "{{ trans('Please add Position') }}",
                },
            });
        });

    </script>
@endsection
