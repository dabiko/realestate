@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create Property Type
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
            <h4 class="mb-3 mb-md-0">Create Property Amenity</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.amenity.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Amenity Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.amenity.index')}}">Amenity Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Amenity</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="amenityForm" method="POST" action="{{route('admin.amenity.store')}}">

                            @csrf
                            @method('POST')


                            <div class="form-group mb-3">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        <div class="mb-3">
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


                            <button type="submit" class="btn btn-primary">
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
        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                // validate form on keyup and submit
                $("#amenityForm").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 4,
                            maxlength: 50
                        },

                        status: {
                            required: true,

                        },

                    },

                    messages: {
                        name: {
                            required: "Please enter a name",
                            minlength: "Name must consist of at least 4 characters",
                            maxlength: "Name must consist of at most 50 characters"
                        },

                        status: {
                            required: "Status is required",
                        },


                    },
                    errorPlacement: function(error, element) {
                        error.addClass( "invalid-feedback" );

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        }
                        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                            error.insertAfter(element.parent().parent());
                        }
                        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.appendTo(element.parent().parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                        }
                    },
                    unhighlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                        }
                    }
                });
            });
        });
    </script>
@endpush
