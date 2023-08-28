@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Properties
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
            <h4 class="mb-3 mb-md-0">Property</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Property
                </button>
            </a>


        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Properties</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Thumbnail</th>
                                <th>Category</th>
                                <th>Agent Name</th>
                                <th>Status</th>
                                <th>Video</th>
                                <th>Low Price</th>
                                <th>Max Price</th>
                                <th>Type</th>
                                <th>Tag</th>
                                <th >Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                  @if($properties->Count() > 0)
                                      @foreach($properties as $key => $property)

                                          <tr>
                                              <td>
                                                  <button type="button" class="btn btn-inverse-info">{{$key+1}}</button>
                                              </td>
                                              <td>{{$property->name}}</td>
                                              <td>
                                                  <img  class="square" style="width: 50px; height: 50px" src="{{asset($property->thumbnail)}}" alt="thumbnail">
                                              </td>
                                              <td>{{$property->category}}</td>
                                              <td>{{$property->agent->name}}</td>
                                              <td>
                                                  @if($property->status === 1)
                                                      <div class="form-check form-switch">
                                                          <input
                                                              class="form-check-input change-status"
                                                              type="checkbox" id="activeChecked"
                                                              data-id="{{$property->id}}"
                                                              checked>
                                                      </div>
                                                  @else
                                                      <div class="form-check form-switch">
                                                          <input
                                                              class="form-check-input change-status"
                                                              type="checkbox"
                                                              data-id="{{$property->id}}"
                                                              id="inActiveChecked">
                                                      </div>
                                                  @endif
                                              </td>
                                              <td>
                                                  @if(!empty($property->video))
                                                      <a href="{{$property->video}}" target="_blank" class="p-2 btn btn-inverse-danger"> <i data-feather="youtube"></i></a>
                                                  @else
                                                      <a class="p-2 btn btn-inverse-secondary"> <i data-feather="youtube"></i></a>
                                                  @endif
                                              </td>
                                              <td>{{$property->lowest_price}}</td>
                                              <td>{{$property->maximum_price}}</td>
                                              <td>
                                                  @if($property->property_for === 'buy')
                                                      <button type="button" class="btn btn-inverse-primary">Buy</button>
                                                  @elseif($property->property_for === 'sale')
                                                      <button type="button" class="btn btn-inverse-secondary">Sale</button>
                                                  @elseif($property->property_for === 'rent')
                                                      <button type="button" class="btn btn-inverse-success">Rent</button>
                                                  @else
                                                      <button type="button" class="btn btn-inverse-danger">Ops Error!</button>
                                                  @endif
                                              </td>
                                              <td>
                                                  @if($property->property_tag === 'hot')
                                                      <button type="button" class="btn btn-inverse-primary">Hot</button>
                                                  @elseif($property->property_tag === 'featured')
                                                      <button type="button" class="btn btn-inverse-warning">Featured</button>
                                                  @else
                                                      <button type="button" class="btn btn-inverse-danger">Ops Error!</button>
                                                  @endif
                                              </td>
                                              <td>
                                                  <button type="button" class="p-1 btn btn-inverse-info"><i data-feather="eye"></i></button>
                                                  <a href="{{route('admin.property.edit', Crypt::encryptString($property->id))}}" class="p-1 btn btn-inverse-primary"> <i data-feather="edit"></i></a>
                                                  <a href="{{route('admin.property.destroy', Crypt::encryptString($property->id))}}" class="p-1 btn btn-inverse-danger delete-item"> <i data-feather="trash"></i></a>
                                                  <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="p-1 btn btn-inverse-info">More<i data-feather="eye"></i></button>
                                              </td>
                                          </tr>


                                          <!-- Modal -->
                                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">{{$property->property_name}}</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                          ...
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          <button type="button" class="btn btn-primary">Save changes</button>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endforeach
                                  @else
                                      <tr>
                                          <td colspan="100%" style="text-align: center;">
                                                  <div class="alert alert-primary" role="alert">
                                                      <i data-feather="alert-circle"></i>
                                                      <strong>Oops No Data Available!!! </strong> Create property.. <a href="{{route('admin.property.create')}}">Here</a>
                                                  </div>
                                          </td>
                                      </tr>
                                  @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        // change property status
        $(document).ready(function(){
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
                    url: "{{route('admin.property.change-status')}}",
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
@endpush
