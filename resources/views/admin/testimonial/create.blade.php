@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create testimonial
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
            <h4 class="mb-3 mb-md-0">Create testimonial</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.testimonials.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Testimonial Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.testimonials.index')}}">Testimonials Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creating testimonial</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="testimonialForm"
                        method="POST"
                        action="{{route('admin.testimonials.store')}}"
                         enctype="multipart/form-data"
                    >

                            @csrf
                            @method('POST')


                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img style="width: 20%; height: 20%" id="show-image" src="{{url('upload/no_image.jpg')}}" alt="">
                        </div>

                        <div class="row mb-3">
                            <div class=" col-md-12">
                                <label  class="mb-1" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class=" col-md-6">
                                <label  class="mb-1" for="position">{{__('Position')}}</label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror" name="position" id="position" >
                                @error('position')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" col-md-6">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group col-md-12 mb-3">
                            <label for="message" class="form-label">{{ __('Short Description') }}</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" >

                            </textarea>
                            @error('message')
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
                $("#stateForm").validate({
                    rules: {
                        image: {
                            required: true,
                        },
                        name: {
                            required: true,
                        },

                        status: {
                            required: true,

                        },

                    },

                    messages: {
                        image: {
                            required: "State image is required",
                        },
                        name: {
                            required: "Please enter a name",
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


            $(document).ready(function () {
                $('#image').change(function (event) {

                    let reader = new FileReader();

                    reader.onload = function (event) {

                        $('#show-image').attr('src', event.target.result);

                    };

                    reader.readAsDataURL(event.target.files['0']);

                })
            })
        });
    </script>
@endpush
