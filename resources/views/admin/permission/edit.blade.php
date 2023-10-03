@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$permission->name}}
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
            <h4 class="mb-3 mb-md-0">Edit <code>{{$permission->name}} </code> Permission</h4>
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
            <li class="breadcrumb-item"><a href="{{route('admin.amenity.index')}}">AmenityTable</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit <code>{{$permission->name}} </code></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="editPermissions" method="POST" action="{{route('admin.permissions.update', Crypt::encryptString($permission->id))}}">

                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$permission->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="group_name" class="form-label">{{ __('Group Name') }}</label>
                                <select class="js-example-basic-single form-select @error('group_name') is-invalid @enderror" data-width="100%" name="group_name" id="group_name" >
                                    <option {{$permission->group_name === '' ? 'selected' : ''}} value="1">Active</option>
                                    <option selected disabled>Select group name</option>
                                    <option {{$permission->group_name === 'categories' ? 'selected' : ''}} value="categories">categories</option>
                                    <option {{$permission->group_name === 'amenities' ? 'selected' : ''}} value="amenities">amenities</option>
                                    <option {{$permission->group_name === 'facilities' ? 'selected' : ''}} value="facilities">facilities</option>
                                    <option {{$permission->group_name === 'details' ? 'selected' : ''}} value="details">details</option>
                                    <option {{$permission->group_name === 'states' ? 'selected' : ''}} value="states">states</option>
                                    <option {{$permission->group_name === 'properties' ? 'selected' : ''}} value="properties">properties</option>
                                    <option {{$permission->group_name === 'packages' ? 'selected' : ''}} value="packages">packages</option>
                                    <option {{$permission->group_name === 'message' ? 'selected' : ''}} value="message">message</option>
                                    <option {{$permission->group_name === 'testimonials' ? 'selected' : ''}} value="testimonials">testimonials</option>
                                    <option {{$permission->group_name === 'blog' ? 'selected' : ''}} value="blog">blog</option>
                                    <option {{$permission->group_name === 'blog_categories' ? 'selected' : ''}} value="blog_categories">blog categories</option>
                                    <option {{$permission->group_name === 'blog_post' ? 'selected' : ''}} value="blog_post">blog post</option>
                                    <option {{$permission->group_name === 'blog_comments' ? 'selected' : ''}} value="blog_comments">blog comments</option>
                                    <option {{$permission->group_name === 'manage_account' ? 'selected' : ''}} value="manage_account">manage account</option>
                                    <option {{$permission->group_name === 'site_settings' ? 'selected' : ''}} value="site_settings">site settings</option>
                                    <option {{$permission->group_name === 'permissions' ? 'selected' : ''}} value="permissions">permissions</option>
                                    <option {{$permission->group_name === 'roles' ? 'selected' : ''}} value="roles">roles</option>

                                </select>
                                @error('group_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary">
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
        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                // validate form on keyup and submit
                $("#editPermissions").validate({
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
