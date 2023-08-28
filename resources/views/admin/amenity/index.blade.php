@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Amenity
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
            <h4 class="mb-3 mb-md-0">Property Amenity</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.amenity.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Amenity
                </button>
            </a>


        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property Amenity</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Amenities</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amenity Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                  @if($amenities->Count()) > 0)
                                      @foreach($amenities as $key => $amenity)

                                          <tr>
                                              <td>
                                                  <button type="button" class="btn btn-inverse-info">{{$key+1}}</button>
                                              </td>
                                              <td>{{$amenity->name}}</td>
                                              <td>
                                                  @if($amenity->status === 1)
                                                      <div class="form-check form-switch">
                                                          <input
                                                              class="form-check-input change-status"
                                                              type="checkbox" id="activeChecked"
                                                              data-id="{{$amenity->id}}"
                                                              checked>
                                                      </div>
                                                  @else
                                                      <div class="form-check form-switch">
                                                          <input
                                                              class="form-check-input change-status"
                                                              type="checkbox"
                                                              data-id="{{$amenity->id}}"
                                                              id="inActiveChecked">
                                                      </div>
                                                  @endif
                                              </td>
                                              <td>
                                                  <a href="{{route('admin.amenity.edit', Crypt::encryptString($amenity->id))}}" class="btn btn-inverse-primary"> <i data-feather="edit"></i></a>
                                                  <a href="{{route('admin.amenity.destroy', Crypt::encryptString($amenity->id))}}" class="btn btn-inverse-danger delete-item"> <i data-feather="trash"></i></a>
                                              </td>
                                          </tr>
                                      @endforeach
                                  @else
                                      <tr>
                                          <td colspan="100%" style="text-align: center;">
                                              <div class="alert alert-primary" role="alert">
                                                  <i data-feather="alert-circle"></i>
                                                  <strong>Oops No Data Available!!! </strong> Create amenity.. <a href="{{route('admin.amenity.create')}}">Here</a>
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
                    url: "{{route('admin.amenity.change-status')}}",
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
