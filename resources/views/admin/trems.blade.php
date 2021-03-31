@extends('admin.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <form id='myform' action="{{ url('admin/trems') }}" method="post" role="form" enctype="multipart/form-data" >
          <div class="card">

              <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ $title }}</div>
              <div class="card-body">
                    {{ csrf_field() }}
                    <textarea name="trems"  id="editor1" rows="10" cols="80">{{ $data->trems }}</textarea>
                    {{ $errors->trems->first('trems') }}
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-primary pull-right" type="submit"> {{ trans('lang.submit') }}</button>
                {{-- <button class="btn btn-sm btn-danger" type="reset"> Reset</button> --}}
              </div>

          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
  <script type="text/javascript">
  CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('editor1');

  </script>


@endsection

