@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | {{$property->name}} coordinates
@endsection

@section('content')
    @if(Session::has('status'))
        <script>
            ToastToRight.fire({
                icon: '{{Session::get('status')}}',
                title: '{{Session::get('message')}}',
            })
        </script>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Coordinates : {{$property->name}} </h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                     Property Table
                </button>
            </a>


        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Provide coordinates</h6>
                    <div class="table-responsive"></div>
                    <form
                        method="post"
                        action="{{ route('agent.property-map.store') }}"
                    >
                        @method('post')
                        @csrf

                        <div id="preview_img" class="d-flex align-items-center mb-3">

                        </div>

                       <div class="row mb-3">

                           <div class="col-md-6">
                               <label for="latitude" class="form-label">{{ __('Latitude') }} | <code><a href="https://www.latlong.net/" target="_blank">Click here to get the exact coordinates *</a></code></label>
                               <input id="latitude"  value="{{$coordinates?->latitude}}" class="form-control @error('latitude') is-invalid @enderror" name="latitude" type="text">
                               @error('latitude')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>

                           <input id="property_id" class="form-control" name="property_id" type="hidden" value="{{Crypt::encryptString($property->id)}}">
                           <input id="map_id" class="form-control" name="map_id" type="hidden" value="{{Crypt::encryptString($coordinates?->id)}}">

                           <div class="col-md-6 ">
                               <label for="longitude" class="form-label">{{ __('Longitude') }} | <code><a href="https://www.latlong.net/" target="_blank">Click here to get the exact coordinates *</a></code></label>
                               <input id="longitude" value="{{$coordinates?->longitude}}" class="form-control @error('longitude') is-invalid @enderror" name="longitude" type="text">
                               @error('longitude')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                           </div>
                       </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                                <i class="btn-icon-prepend" data-feather="upload"></i>
                                {{__( 'Upload')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.property.index')}}">Properties Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Coordinates</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>


                                  @if($propertyMaps->Count() > 0)
                                        @if($count > 0)
                                            {{ $dataTable->table() }}
                                        @else
                                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>Longitude</th>
                                        <th>Latitude</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="100%" style="text-align: center;">
                                            <div class="alert alert-primary" role="alert">
                                                <i data-feather="alert-circle"></i>
                                                <strong>Oops No Data Available!!! </strong> Add coordinates
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                                        @endif
                                  @else
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>Num</th>
                                                <th>Longitude</th>
                                                <th>Latitude</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <tr>
                                                      <td colspan="100%" style="text-align: center;">
                                                              <div class="alert alert-primary" role="alert">
                                                                  <i data-feather="alert-circle"></i>
                                                                  <strong>Oops No Data Available!!! </strong> Add coordinates
                                                              </div>
                                                      </td>
                                                  </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function (){

            $('#image').on('change', function(){
                if (window.File && window.FileReader && window.FileList && window.Blob)
                {
                    let data = $(this)[0].files;

                    $.each(data, function(index, file){
                        if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){
                            let fRead = new FileReader();
                            fRead.onload = (function(file){
                                return function(e) {
                                    let img = $('<img class="m-2" src="" alt="preview"/>').addClass('thumb').attr('src', e.target.result)
                                        .width(130)
                                        .height(80);
                                    $('#preview_img').append(img) ;
                                };
                            })(file);
                            fRead.readAsDataURL(file);
                        }
                    });

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Your browser does not support File API!',
                    })
                }
            });
        })

    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
