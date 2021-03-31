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

                            <form id='myform' action="{{ url('admin/edit-yacht-category') }}" method="post" role="form"
                                enctype="multipart/form-data">
                                {{ csrf_field() }} 
                                <input type="hidden" name="encryption_id" value="{{ base64_encode($data->id) }}">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>{{ trans('lang.Yach tCategory Name English') }}</label>
                                            <input type="text" id="categoryName" name="categoryName" value="{{ $data->categoryName }}"
                                            placeholder="{{ trans('lang.Yach tCategory Name English') }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>{{ trans('lang.YachtCategoryName Arabic') }}</label>
                                            <input type="text" id="categoryNameAr" name="categoryNameAr" value="{{ $data->categoryNameAr }}"
                                                placeholder="{{ trans('lang.YachtCategoryName Arabic') }}" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label for="Image">{{ trans('lang.YachtCategoryimage') }}</label>
                                    <input type="file" name="image" class="form-control" id="image"
                                        placeholder="Image" style="width: auto">
                                        <div class="col-md-6">
                                            <img src="{{ $data->image }}" width="120" height="90">
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
