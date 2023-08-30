@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | {{$property->name}} Variants
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
            <h4 class="mb-3 mb-md-0">{{$property->name}} Variants</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property.index')}}">
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
                    <h6 class="card-title">Create Variant</h6>

                    <form
                        method="post"
                        action="{{ route('admin.property-variant.store') }}"

                    >
                        @method('post')
                        @csrf

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Variant Name') }}  <code>*</code></label>
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" >
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input id="property_id" class="form-control @error('property_id') is-invalid @enderror" name="property_id" type="hidden" value="{{request()->property}}">
                            @error('property_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="col-md-6">
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" >
                                    <option selected disabled>Select variant status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-inverse-primary btn-icon-text mb-2 mb-md-0">
                                <i class="btn-icon-prepend" data-feather="upload"></i>
                                {{__( 'Save')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.property.index')}}">Properties Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Statistics</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>


                                  @if($propertyVariant->Count() > 0)

                                      {{ $dataTable->table() }}

                                  @else
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Property Name</th>
                                                <th> Variant</th>
                                                <th>Status</th>
                                                <th >Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <tr>
                                                      <td colspan="100%" style="text-align: center;">
                                                              <div class="alert alert-primary" role="alert">
                                                                  <i data-feather="alert-circle"></i>
                                                                 Oops No Data Available for  <strong>{{$property->name}} !!! </strong> Add Variants
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
                    url: "{{route('admin.property-variant.change-status')}}",
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
