@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | {{$property->name}}
@endsection

@section('content')
    @if(Session::has('status'))
        <script>
            ToastToRight.fire({
                icon: '{{Session::get('status')}}',
                title: '{{Session::get('message')}}',
            })
        </script>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Amenity : {{$property->name}} </h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                     Property Table
                </button>
            </a>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form
                        id="propertyForm"
                        method="POST"
                        action="{{route('agent.property-amenity.store')}}"

                    >

                        @csrf
                        @method('POST')

                        <input type="hidden" name="property_id" id="property_id" class="form-control" value="{{Crypt::encryptString($property->id)}}">

                        <div class="row mb-3">
                            <div class="form-group col-md-6 ">
                                <label for="amenity_id" class="form-label">{{ __('Amenity') }}</label>
                                <select class="js-example-basic-multiple form-select @error('amenity_id') is-invalid @enderror"   data-width="100%" name="amenity_id" id="amenity_id" >
                                    <option selected disabled>Select amenity</option>
                                    @foreach($amenities as $amenity)
                                        <option   value="{{$amenity->id}}">{{$amenity->name}}</option>
                                    @endforeach
                                </select>
                                @error('amenity_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row col-md-6">
                                <div class="  mb-3">
                                    <label for="status" class="form-label">{{ __('Status') }}</label>
                                    <select class="form-select  @error('status') is-invalid @enderror" name="status" id="status" >
                                        <option selected disabled>Select status</option>
                                        <option  value="1">{{__('Active')}}</option>
                                        <option  value="0">{{__('Inactive')}}</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-inverse-primary">
                            <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Save')}}
                        </button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.property.index')}}">Properties</a></li>
            <li class="breadcrumb-item active" aria-current="page">Amenities</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Amenities</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>


                                  @if($property_amenity->Count() > 0)
                                      @if($count > 0)
                                             {{ $dataTable->table() }}
                                      @else
                                              <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>Num</th>
                                        <th>Icon</th>
                                        <th>Amenity</th>
                                        <th>Status</th>
                                        <th >Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="100%" style="text-align: center;">
                                            <div class="alert alert-primary" role="alert">
                                                <i data-feather="alert-circle"></i>
                                                 <strong>Oops No Data Available!!! </strong> Add amenities
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                                      @endif
                                  @else
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>Num</th>
                                                <th>Icon</th>
                                                <th>Amenity</th>
                                                <th>Status</th>
                                                <th >Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <tr>
                                                      <td colspan="100%" style="text-align: center;">
                                                              <div class="alert alert-primary" role="alert">
                                                                  <i data-feather="alert-circle"></i>
                                                                  <strong>Oops No Data Available!!! </strong> Add amenities
                                                              </div>
                                                      </td>
                                                  </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.change-status', function (event){
                // event.preventDefault();

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('agent.property-amenity.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id,
                    },
                    success: function (data){
                        if(data.status === 'success'){
                            ToastCenter.fire({
                                icon: data.status,
                                title: data.message,
                            })
                            // window.setTimeout(function(){
                            //     location.reload();
                            // } ,1000);
                        }else if(data.status === 'error'){
                            Swal.fire({
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: true,
                            })
                        }

                    },
                    error: function (xhr, status, error){
                        console.log(error);
                    }

                })
            })
        })

    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
