@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$post->title}}
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
            <h4 class="mb-3 mb-md-0">Edit {{$post->title}} Blog Post</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.blog-post.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                     Blog Post Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Blog Post Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$post->title}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        method="POST"
                        action="{{route('admin.blog-post.update', Crypt::encryptString($post->id))}}"
                        id="postEditForm"
                    >

                            @csrf
                            @method('PUT')

                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img style="width: 20%; height: 20%" id="show-image" src="{{asset($post->image)}}" alt="">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label  class="mb-1" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{$post->title}}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <label for="blog_category_id" class="form-label">{{ __(' Blog Category') }}</label>
                                <select class="js-example-basic-single form-select @error('blog_category_id') is-invalid @enderror" data-width="100%" name="blog_category_id" id="blog_category_id" >
                                    <option selected disabled>Select category</option>
                                    @foreach($categories as $category)
                                        <option {{ $category->id === $post->blog_category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tags" class="form-label">{{ __(' Tag') }}</label>
                                <input class="form-control @error('tag') is-invalid @enderror" name="tags[]" id="tags" value="{{$post->tags}}">
                                @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <label for="short_desc" class="form-label">{{ __('Short Description') }}</label>
                                <textarea class="form-control @error('short_desc') is-invalid @enderror" name="short_desc" id="short_desc" >
                                     {{$post->short_desc}}
                                </textarea>
                                @error('short_desc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group  col-md-6">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option selected disabled>Select status</option>
                                    <option {{ $post->status === 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $post->status === 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group mb-3">
                            <label for="long_desc" class="form-label">{{ __('Long Description') }}</label>
                            <textarea id="tinymceExample" class="form-control @error('long_desc') is-invalid @enderror" name="long_desc" >
                                    {{$post->long_desc}}
                            </textarea>
                            @error('long_desc')
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
                $("#postEditForm").validate({
                    rules: {

                        title: {
                            required: true,
                            minlength: 4,
                            maxlength: 150
                        },

                        blog_category_id: {
                            required: true,
                        },

                        tags: {
                            required: true,
                        },
                        short_desc: {
                            required: true,
                        },
                        tinymceExample: {
                            required: true,
                        },

                        status: {
                            required: true,

                        },

                    },

                    messages: {

                        title: {
                            required: "Please enter a title",
                            minlength: "Name must consist of at least 4 characters",
                            maxlength: "Name must consist of at most 50 characters"
                        },

                        blog_category_id: {
                            required: "Blog Category is required",
                        },

                        tags: {
                            required: "Tag is required",
                        },
                        short_desc: {
                            required: "Short description is required",
                        },

                        tinymceExample: {
                            required: "Long description is required",
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


        $(document).ready(function () {
            $('#image').change(function (event) {

                let reader = new FileReader();

                reader.onload = function (event) {

                    $('#show-image').attr('src', event.target.result);

                };

                reader.readAsDataURL(event.target.files['0']);

            })
        })

    </script>
@endpush
