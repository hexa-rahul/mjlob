@extends('admin.base')

@section('content')

    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i> {{ $title }}</div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="col-6 mx-auto d-block">
                                        <div class="card">
                                            <div class="card-header"> {{ ucfirst($data->yachtName) }} <small>{{ trans('lang.Photos') }}</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="carousel slide" id="carouselExampleIndicators"
                                                    data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @php $i=1; @endphp
                                                        @foreach ($data->yachtPhotos as $Photos)

                                                            <div class="carousel-item <?php if($i == 1){ echo "active"; } ?>" ><img class="d-block w-100"
                                                            data-src="holder.js/800x400?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second slide"
                                                            alt="{{ ucfirst($data->yachtName) }} photos"
                                                            src="{{ $Photos->yachtPhoto }}" data-holder-rendered="true">
                                                    </div>
                                                    @php $i++; @endphp
                                                    @endforeach
                                                </div><a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                    role="button" data-slide="prev"><span class="carousel-control-prev-icon"
                                                        aria-hidden="true"></span><span
                                                        class="sr-only">Previous</span></a><a class="carousel-control-next"
                                                    href="#carouselExampleIndicators" role="button" data-slide="next"><span
                                                        class="carousel-control-next-icon" aria-hidden="true"></span><span
                                                        class="sr-only">Next</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <img class="mx-auto d-block img-thumbnail"
                                    src="{{ $data->image }}" width="300px" height="300px"> --}}
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.YachtName') }} :
                                                    </b></label>
                                                <div class="col-sm-8 col-form-label p_0">
                                                    <span>{{ ucfirst($data->yachtName) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12">
                                            <div class="row">
                                                <label for="inputEmail3" class="col-sm-4 col-form-label p_0"><b>{{ trans('lang.Country') }} :
                                                    </b></label>
                                                <div class="col-sm-8 col-form-label p_0">
                                                    <img src="{{ $data->countryData->image }}" width="50px" height="30px">
                                                    {{ ucfirst($data->countryData->countryName) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-5 ">
                                        <div class="row">
                                            <label class="card-header col-sm-12  col-form-label p_0 text-center"><b>{{ trans('lang.GeneralFacilities') }}  </b></label>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Passengers') }} : {{ ucfirst($data->passengers) }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Meter') }} : {{ ucfirst($data->meter) }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Cabins') }} : {{ ucfirst($data->cabins) }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Crews') }} : {{ ucfirst($data->crews) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" ml-auto col-5 float-right">
                                        <div class="row">
                                            <label class="card-header col-sm-12  col-form-label p_0 text-center"><b> {{ trans('lang.GeneralInfo') }} </b></label>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Length') }} : {{ ucfirst($data->generalInfoLength) }} {{ trans('lang.meters') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Beam') }} : {{ ucfirst($data->generalInfoBeam) }}  {{ trans('lang.meters') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Draft') }} : {{ ucfirst($data->generalInfoDraft) }}  {{ trans('lang.meters') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.GrossTonnage') }} : {{ ucfirst($data->generalInfoGrossTonnage) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="row">
                                            <label class="card-header col-sm-12  col-form-label p_0 text-center"><b> {{ trans('lang.Build&Design') }} </b></label>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Builder') }} : {{ ucfirst($data->builder) }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.yearOfBuild') }} : {{ ucfirst($data->yearOfBuild) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-auto col-5">
                                        <div class="row">
                                            <label class="card-header col-sm-12  col-form-label p_0 text-center"><b>{{ trans('lang.PropulsionPerformances') }}</b></label>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Maxspeed') }} : {{ ucfirst($data->maxspeed) }} {{ trans('lang.Kn') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Cruisingspeed') }} : {{ ucfirst($data->cruisingSpeed) }} {{ trans('lang.Kn') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Fuelconsumption') }} : {{ ucfirst($data->fuelConsumption) }} {{ trans('lang.lt/h') }}
                                            </div>
                                            <div class="col-sm-6 col-form-label p_0">
                                                {{ trans('lang.Fuelconsumption') }} : {{ ucfirst($data->gasoilTank) }} {{ trans('lang.liters') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="col-5">
                                    <div class="row">
                                        <label
                                            class="card-header col-sm-12  col-form-label p_0 text-center"><b>{{ trans('lang.Engine') }}</b></label>
                                        <div class="col-sm-6 col-form-label p_0">
                                            {{ trans('lang.Manufacturer') }} : {{ ucfirst($data->EngineManufacturer) }}
                                        </div>
                                        <div class="col-sm-6 col-form-label p_0">
                                            {{ trans('lang.Model') }} : {{ ucfirst($data->EngineModel) }}
                                        </div>
                                        <div class="col-sm-6 col-form-label p_0">
                                            {{ trans('lang.Type') }} : {{ ucfirst($data->EngineType) }} {{ trans('lang.HP') }}
                                        </div>
                                        <div class="col-sm-6 col-form-label p_0">
                                            {{ trans('lang.TotalPower') }} : {{ ucfirst($data->EngineTotalpower) }} {{ trans('lang.HP') }}
                                        </div>
                                        <div class="col-sm-6 col-form-label p_0">
                                            {{ trans('lang.Quantity') }} : {{ ucfirst($data->EngineQuantity) }} {{ trans('lang.liters') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- <div class="col-12">
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="card card-accent-info">
                                    <div class="card-header">Card with accent</div>
                                    <div class="card-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                        diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
                                        Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit
                                        lobortis nisl ut aliquip ex ea commodo consequat.</div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="card-footer">
                        <a href="{{ route('user.list') }}" class="btn btn-sm btn-primary pull-right">{{ __('Return') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@section('javascript')

@endsection
