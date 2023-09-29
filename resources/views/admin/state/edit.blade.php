@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$state->name}}
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
            <h4 class="mb-3 mb-md-0">Edit {{$state->name}} Anemity</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.state.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Amenity Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.state.index')}}">AmenityTable</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$state->name}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="stateForm"
                        method="POST"
                        action="{{route('admin.state.update', Crypt::encryptString($state->id))}}"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')


                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img style="width: 20%; height: 20%" id="show-image" src="{{asset($state->image)}}" alt="">
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
                                    @foreach(config('settings.state_list') as  $key => $states)
                                        <option {{ $state->name == $states['name'] ? 'selected' : '' }} value="{{$states['name']}}">{{$states['name']}}</option>
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
                                <option  {{ $state->status === 1 ? 'selected' : '' }} value="1">Active</option>
                                <option  {{ $state->status === 0 ? 'selected' : '' }} value="0">Inactive</option>
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
