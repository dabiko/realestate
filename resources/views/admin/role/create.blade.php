@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create Permission
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
            <h4 class="mb-3 mb-md-0">Create Permission</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.permissions.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Permission Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.permissions.index')}}">Permissions Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Permission</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="permissionsForm" method="POST" action="{{route('admin.permissions.store')}}">

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
                            <label for="group_name" class="form-label">{{ __('Group Name') }}</label>
                            <select class="js-example-basic-single form-select  @error('group_name') is-invalid @enderror" data-width="100%" name="group_name" id="group_name" >
                                <option selected disabled>Select group name</option>
                                <option value="categories">categories</option>
                                <option value="amenities">amenities</option>
                                <option value="facilities">facilities</option>
                                <option value="details">details</option>
                                <option value="states">states</option>
                                <option value="properties">properties</option>
                                <option value="packages">packages</option>
                                <option value="message">message</option>
                                <option value="testimonials">testimonials</option>
                                <option value="blog">blog</option>
                                <option value="blog_categories">blog categories</option>
                                <option value="blog_post">blog post</option>
                                <option value="blog_comments">blog comments</option>
                                <option value="manage_account">manage account</option>
                                <option value="site_settings">site settings</option>
                                <option value="permissions">permission</option>
                                <option value="roles">roles</option>
                            </select>
                            @error('group_name')
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
                $("#permissionsForm").validate({
                    rules: {
                        name: {
                            required: true,
                        },

                        group_name: {
                            required: true,
                        },
                    },

                    messages: {
                        name: {
                            required: "Please enter a name",
                        },

                        group_name: {
                            required: "Please enter a group name",
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
