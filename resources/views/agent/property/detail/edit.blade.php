@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$property_detail->detail->name}}
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
            <h4 class="mb-3 mb-md-0">Edit : {{$property_detail->detail->name}}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property-detail.index', ['property' => Crypt::encryptString($property_detail->property_id )])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                    Details Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.property-detail.index', ['property' =>  Crypt::encryptString($property_detail->property_id)])}}">Detail  Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="propertyForm"
                        method="POST"
                        action="{{route('agent.property-detail.update', Crypt::encryptString($property_detail->id ) )}}"
                    >

                        @csrf
                        @method('PUT')

                        <div class="row mb-3">

                            <div class="form-group col-md-6">
                                <label for="detail_id" class="form-label">{{ __(' Name') }}</label>
                                <select class="js-example-basic-single form-select @error('detail_id') is-invalid @enderror" data-width="100%" name="detail_id" id="detail_id" >
                                    <option selected disabled>Select name</option>
                                    @foreach($details as $detail)
                                        <option {{$detail->id === $property_detail->detail_id ? 'selected' : ''}} value="{{Crypt::encryptString($detail->id)}}">{{$detail->name}}</option>
                                    @endforeach
                                </select>
                                @error('detail_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 ">
                                <label  class="mb-2" for="value">{{__('Value')}}</label>
                                <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" id="value" value="{{$property_detail->value}}">
                                <input type="hidden" class="form-control @error('property_id') is-invalid @enderror" name="property_id" id="property_id" value="{{Crypt::encryptString($property_detail->property_id)}}">
                                @error('value')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-3">

                            <div class="form-group">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option selected disabled>Select status</option>
                                    <option {{$property_detail->status === 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{$property_detail->status === 0 ? 'selected' : ''}} value="0">Inactive</option>
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


