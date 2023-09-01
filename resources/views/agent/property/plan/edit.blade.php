@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Edit Plan
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
            <h4 class="mb-3 mb-md-0">Edit plan : {{$property_plan->name}}</h4>
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
                        action="{{route('agent.property-plan.update',  Crypt::encryptString($property_plan->id))}}"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')

                        <div class="row mb-3">

                            <h5 class="mb-2">Image Preview</h5>
                            <div class="d-flex align-items-center mb-3">
                                <img style="width: 140px; height: 80px" id="show-image" src="{{asset($property_plan->image)}}" alt="..">
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
                                <input class=" form-control @error('name') is-invalid @enderror" value="{{$property_plan->name}}" name="name" id="name" />

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>


                        <div class="form-group mb-3 ">
                            <label  class="mb-2" for="short_desc">{{__('Short Description')}}</label>
                            <textarea type="text" class="form-control @error('short_desc') is-invalid @enderror" name="short_desc" id="short_desc" value="">
                                {{$property_plan->short_desc}}
                            </textarea>
                            <input type="hidden" class="form-control" name="property_id" id="property_id" value="{{Crypt::encryptString($property_plan->property_id)}}">
                            @error('short_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3  ">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                <option selected disabled>Select status</option>
                                <option {{ $property_plan->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                <option {{ $property_plan->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
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

