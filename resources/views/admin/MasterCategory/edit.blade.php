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

                            <form id='myform' action="{{ url('admin/edit-category') }}" method="post" role="form"
                                enctype="multipart/form-data">
                                {{ csrf_field() }} 
                                <input type="hidden" name="encryption_id" value="{{ base64_encode($data->id) }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ trans('lang.category_english') }}</label>
                                            <input type="text" id="name" name="name" value="{{ $data->name }}"
                                            placeholder="{{ trans('lang.category_english') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('lang.category_arabic') }}</label>
                                            <input type="text" id="name_ar" name="name_ar" value="{{ $data->name_ar }}"
                                                placeholder="{{ trans('lang.category_arabic') }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right"
                                            style="margin-right: -14px;"> {{ trans('lang.submit') }} </button>
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
                    categoryName: {
                        required: true,
                    },

                },
                messages: {
                    categoryName: "Please Enter Category Name",
                },
            });
        });

    </script>
@endsection
