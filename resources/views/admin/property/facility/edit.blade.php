@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | {{$property_facility->property->name}} Facility
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
            <h4 class="mb-3 mb-md-0"> Edit : {{$property_facility->property->name}} </h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property-facility.index', ['property' =>  Crypt::encryptString($property_facility->property_id)])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                     Facility Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.property-facility.index', ['property' => Crypt::encryptString($property_facility->property_id)])}}">Facility Table</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$property_facility->facility->name}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="propertyForm"
                        method="POST"
                        action="{{route('admin.property-facility.update', Crypt::encryptString($property_facility->id))}}"

                    >

                        @csrf
                        @method('PUT')

                        <input type="hidden" name="property_id" id="property_id" class="form-control" value="{{Crypt::encryptString($property_facility->property_id)}}">


                        <div class="row mb-3">
                            <div class=" col-md-6 ">
                                <label for="facility" class="form-label">{{ __('Facility Category') }}</label>
                                <select class="js-example-basic-single form-select  @error('facility') is-invalid @enderror"  data-width="100%" name="facility" id="facility" >
                                    <option selected disabled>Select category</option>
                                    @foreach($facilities as $facility)
                                        <option {{$property_facility->facility_id === $facility->id ? 'selected' : ''}} value="{{Crypt::encryptString($facility->id)}}">{{$facility->name}}</option>
                                    @endforeach
                                </select>
                                @error('facility')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="name">{{__('Facility Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$property_facility->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="distance" class="form-label"> Distance  <code>( Km ) * </code></label>
                                    <input type="text" name="distance" id="distance" class="form-control  @error('distance') is-invalid @enderror" value="{{$property_facility->distance}}" placeholder="Distance (Km)">
                                    @error('distance')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row col-md-6">
                                <div class="  mb-3">
                                    <label for="rating" class="form-label">{{ __('Rating') }}</label>
                                    <select class="js-example-basic-single form-select  @error('rating') is-invalid @enderror"  data-width="100%" name="rating" id="rating" >
                                        <option {{ $property_facility->rating == 0 ? 'selected' : '' }} value="0">{{__('0')}}</option>
                                        <option {{ $property_facility->rating == 1 ? 'selected' : '' }} value="1">{{__('1')}}</option>
                                        <option {{ $property_facility->rating == 1.5 ? 'selected' : '' }} value="1.5">{{__('1.5')}}</option>
                                        <option {{ $property_facility->rating == 2 ? 'selected' : '' }} value="2">{{__('2')}}</option>
                                        <option {{ $property_facility->rating == 2.5 ? 'selected' : '' }} value="2.5">{{__('2.5')}}</option>
                                        <option {{ $property_facility->rating == 3 ? 'selected' : '' }} value="3">{{__('3')}}</option>
                                        <option {{ $property_facility->rating == 3.5 ? 'selected' : '' }} value="3.5">{{__('3.5')}}</option>
                                        <option {{ $property_facility->rating == 4 ? 'selected' : '' }} value="4">{{__('4')}}</option>
                                        <option {{ $property_facility->rating == 4.5 ? 'selected' : '' }} value="4.5">{{__('4.5')}}</option>
                                        <option {{ $property_facility->rating == 5 ? 'selected' : '' }} value="5">{{__('5')}}</option>
                                    </select>
                                    @error('rating')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="  mb-3">
                            <label for="status" class="form-label">{{ __('Status') }}</label>
                            <select class="form-select  @error('status') is-invalid @enderror" name="status" id="status" >
                                <option selected disabled>Select status</option>
                                <option {{ $property_facility->status === 1 ? 'selected' : '' }} value="1">{{__('Active')}}</option>
                                <option {{ $property_facility->status === 0 ? 'selected' : '' }} value="0">{{__('Inactive')}}</option>
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
            let counter = 0;
            $(document).on("click",".addeventmore",function(){
                let whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click",".removeeventmore",function(event){
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        })

    </script>
@endpush
