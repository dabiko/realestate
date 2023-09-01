@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | {{$variant->name}}
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
            <h4 class="mb-3 mb-md-0">{{$variant->name}} Varaint</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property-variant-index', ['property' => Crypt::encryptString($variant->id)])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                    Variant Table
                </button>
            </a>
        </div>
    </div>



    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Edit Variant</h6>

                    <form
                        method="POST"
                        action="{{ route('agent.property-variant.update', Crypt::encryptString($variant->id)) }}"

                    >
                        @method('PUT')
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Variant Name') }}  <code>*</code></label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$variant->name}}" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @error('property_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-md-6">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option selected disabled>Select variant status</option>
                                    <option {{$variant->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$variant->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-inverse-primary btn-icon-text mb-2 mb-md-0">
                                <i class="btn-icon-prepend" data-feather="upload"></i>
                                {{__( 'Update')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>


    </script>
@endpush
