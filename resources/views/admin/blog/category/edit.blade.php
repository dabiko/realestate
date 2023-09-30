@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$category->name}}
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
            <h4 class="mb-3 mb-md-0">Edit {{$category->name}} Blog Category</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.blog-category.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                     Blog Category Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Blog Category Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$category->name}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('admin.blog-category.update', Crypt::encryptString($category->id))}}">

                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="form-group col-md-6">
                                    <label  class="mb-1" for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$category->name}}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                        <option selected disabled>Select status</option>
                                        <option {{$category->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$category->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
