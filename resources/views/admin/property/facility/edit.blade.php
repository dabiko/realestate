@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$property->name}}
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
            <h4 class="mb-3 mb-md-0">Edit {{$property->name}} </h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Property Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.property.index')}}">Property Table</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{$property->name}} property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        method="POST"
                        action="{{route('admin.property.update', Crypt::encryptString($property->id))}}"
                        enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img style="width: 20%; height: 20%" id="show-image" src="{{asset($property->thumbnail)}}" alt="">
                        </div>

                        <div class="form-group mb-3">
                            <label  class="mb-1" for="image">{{__('Thumbnail')}}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" >
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$property->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="category_id" class="form-label">{{ __(' Category') }}</label>
                                <select class="js-example-basic-single form-select @error('category_id') is-invalid @enderror" data-width="100%" name="category_id" id="category_id" >
                                    <option selected disabled>Select category</option>
                                    @foreach($categories as $category)
                                        <option {{$category->id === $property->category_id ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-md-6">
                                <label for="agent_id" class="form-label">{{ __('Agent') }}</label>
                                <select class="js-example-basic-single form-select @error('agent_id') is-invalid @enderror" data-width="100%" name="agent_id" id="agent_id" >
                                    <option selected disabled>Select agent</option>
                                    @foreach($agents as $agent)
                                        <option {{$agent->id === $property->agent_id ? 'selected' : '' }} value="{{$agent->id}}">{{$agent->name}}</option>
                                    @endforeach
                                </select>
                                @error('agent_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="video_link">{{__('Video Link')}}</label>
                                <input type="text" class="form-control @error('video_link') is-invalid @enderror" name="video_link" id="video_link" value="{{$property->video_link}}">
                                @error('video_link')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="low_price">{{__('Lowest Price')}}</label>
                                <input type="text" class="form-control @error('low_price') is-invalid @enderror" name="low_price" id="low_price" value="{{$property->low_price}}">
                                @error('low_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="max_price">{{__('Maximum Price')}}</label>
                                <input type="text" class="form-control @error('max_price') is-invalid @enderror" name="max_price" id="max_price" value="{{$property->max_price}}">
                                @error('max_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <label for="purpose" class="form-label">{{ __('Purpose') }}</label>
                                <select class="form-select @error('purpose') is-invalid @enderror" name="purpose" id="purpose" >
                                    <option selected disabled>Select buy or sale</option>
                                    <option {{$property->purpose === 'buy' ? 'selected' : '' }} value="buy">Buy</option>
                                    <option {{$property->purpose === 'sale' ? 'selected' : '' }} value="sale">Sale</option>
                                    <option {{$property->purpose === 'rent' ? 'selected' : '' }} value="rent">Rent</option>
                                </select>
                                @error('purpose')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tag" class="form-label">{{ __(' Tag') }}</label>
                                <select class="form-select @error('tag') is-invalid @enderror" name="tag" id="tag" >
                                    <option selected disabled>Select tag</option>
                                    <option {{$property->tag === 'featured' ? 'selected' : '' }} value="featured">Featured</option>
                                    <option {{$property->tag === 'hot' ? 'selected' : '' }} value="hot">Hot</option>
                                </select>
                                @error('tag')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                                <label for="short_desc" class="form-label">{{ __('Short Description') }}</label>
                                <textarea class="form-control @error('short_desc') is-invalid @enderror" name="short_desc" id="short_desc" >
                                      {{$property->short_desc}}
                            </textarea>
                                @error('short_desc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                        </div>

                        <div class="form-group mb-3">
                            <label for="amenity_id" class="form-label">{{ __('Amenity') }}</label>
                            <select class="js-example-basic-multiple form-select @error('amenity_id') is-invalid @enderror" multiple="multiple"  data-width="100%" name="amenity_id[]" id="amenity_id" >
                                @foreach($amenities as $amenity)
                                    <option {{(in_array($amenity->id, $array_amenity)) ? 'selected' : ''}} value="{{$amenity->id}}">{{$amenity->name}}</option>
                                @endforeach
                            </select>
                            @error('amenity_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="long_desc" class="form-label">{{ __('Long Description') }}</label>
                            <textarea id="tinymceExample" class="form-control @error('long_desc') is-invalid @enderror" name="long_desc" >
                                {{$property->long_desc}}
                            </textarea>
                            @error('long_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="Upload"></i>  {{__('Update')}}
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
