@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create Blog Category
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
            <h4 class="mb-3 mb-md-0">Create Blog Category</h4>
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
            <li class="breadcrumb-item"><a href="{{route('admin.blog-category.index')}}">Blog Category Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Blog Category</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('admin.blog-category.store')}}">

                            @csrf
                            @method('POST')

                           <div class="row mb-3">
                               <div class="form-group col-md-6">
                                   <label  class="mb-1" for="name">{{__('Name')}}</label>
                                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
                                   @error('name')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="form-group  col-md-6">
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
