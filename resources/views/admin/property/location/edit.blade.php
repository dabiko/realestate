@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit Location
@endsection

@section('content')
    @if(Session::has('status'))
        <script>
            Swal.fire({
                icon: '{{Session::get('status')}}',
                title: '{{Session::get('message')}}',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Edit location : {{$property_location->name}}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property-location.index', ['property' => request()->property])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                    Location Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.property-location.index', ['property' => request()->property])}}">Plan  Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Plan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="propertyForm"
                        method="POST"
                        action="{{route('admin.property-location.update',  Crypt::encryptString($property_location->id))}}"
                    >

                        @csrf
                        @method('PUT')

                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"  value="{{$property_location->name}}" name="name" id="name" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="value" class="form-label">{{ __(' Value') }}</label>
                                <input class=" form-control @error('value') is-invalid @enderror" value="{{$property_location->value}}" name="value" id="value" />
                                <input type="hidden" class="form-control" name="property_id" id="property_id" value="{{Crypt::encryptString($property_location->property_id)}}">
                                @error('value')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>



                        <div class="form-group mb-3  ">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                <option selected disabled>Select status</option>
                                <option {{ $property_location->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{ $property_location->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-inverse-primary">
                            <i class="btn-icon-prepend" data-feather="upload"></i>  {{__('Update')}}
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#image').change(function (event) {

                let reader = new FileReader();

                reader.onload = function (event) {

                    $('#show-image').attr('src', event.target.result)
                        .width(130)
                        .height(80);

                };

                reader.readAsDataURL(event.target.files['0']);

            })
        })
    </script>
@endpush

