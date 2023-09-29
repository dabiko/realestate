@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create state
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
            <h4 class="mb-3 mb-md-0">Create State</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.state.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    State Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.state.index')}}">State Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create State</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="stateForm"
                        method="POST"
                        action="{{route('admin.state.store')}}"
                         enctype="multipart/form-data"
                    >

                            @csrf
                            @method('POST')


                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img style="width: 20%; height: 20%" id="show-image" src="{{url('upload/no_image.jpg')}}" alt="">
                        </div>

                        <div class="row mb-3">
                            <div class=" col-md-6">
                                <label  class="mb-1" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class=" col-md-6">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <select class="js-example-basic-single form-select @error('name') is-invalid @enderror" data-width="100%" name="name" id="name" >
                                    <option selected disabled>Select state</option>
                                    @foreach(config('settings.state_list') as  $key => $state)
                                        <option value="{{$state['name']}}">{{$state['name']}}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
