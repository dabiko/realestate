@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Property Plan
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
            <h4 class="mb-3 mb-md-0">Create Details : {{$property->name}}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property-plan.index', ['property' => request()->property])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                    Plan Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.property-plan.index', ['property' => request()->property])}}">Plan  Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="propertyForm"
                        method="POST"
                        action="{{route('agent.property-plan.store')}}"
                        enctype="multipart/form-data"
                    >

                            @csrf
                            @method('POST')

                        <div class="row mb-3">

                            <h5 class="mb-2">Image Preview</h5>
                            <div class="d-flex align-items-center mb-3">
                                <img style="" id="show-image" src="" alt="..">
                            </div>

                            <div class="form-group col-md-6">
                                <label  class="mb-1" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">{{ __(' Name') }}</label>
                                <input class=" form-control @error('name') is-invalid @enderror" name="name" id="name" >

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                                <div class="form-group mb-3 ">
                                    <label  class="mb-2" for="short_desc">{{__('Short Description')}}</label>
                                    <textarea type="text" class="form-control @error('short_desc') is-invalid @enderror" name="short_desc" id="short_desc" value="{{old('short_desc')}}"></textarea>
                                    <input type="hidden" class="form-control" name="property_id" id="property_id" value="{{$property_id}}">
                                    @error('short_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3  ">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                        <option selected disabled>Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            <button type="submit" class="btn btn-inverse-primary">
                                <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Save')}}
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

