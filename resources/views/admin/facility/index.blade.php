@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Facilities Dashboard
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
            <h4 class="mb-3 mb-md-0"> Facility</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.facility.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Facility
                </button>
            </a>


        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Facility</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Facilities</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>
                    @if($facilities->Count() > 0)
                        {{ $dataTable->table() }}
                    @else
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr><th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="100%" style="text-align: center;">
                                        <div class="alert alert-primary" role="alert">
                                            <i data-feather="alert-circle"></i>
                                            <strong>Oops No Data Available!!! </strong> Create facility.. <a href="{{route('admin.facility.create')}}">Here</a>                                        </div>
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
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
                    url: "{{route('admin.facility.change-status')}}",
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
