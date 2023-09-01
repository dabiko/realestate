@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | {{request()->role}} Users
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
            <h4 class="mb-3 mb-md-0"> {{request()->role}}  Users</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            @if(request()->role == 'All')
                <a href="{{route('admin.users.create', ['role' => 'User'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        User
                    </button>
                </a>
                <a href="{{route('admin.users.create', ['role' => 'Agent'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        Agent
                    </button>
                </a>
                <a href="{{route('admin.users.create', ['role' => 'Admin'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        Admin
                    </button>
                </a>
            @elseif(request()->role == 'User')
                <a href="{{route('admin.users.create', ['role' => 'User'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        User
                    </button>
                </a>
            @elseif(request()->role == 'Agent')
                <a href="{{route('admin.users.create', ['role' => 'Agent'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        Agent
                    </button>
                </a>
            @elseif(request()->role == 'Admin')
                <a href="{{route('admin.users.create', ['role' => 'Admin'])}}">
                    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                        <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                        Admin
                    </button>
                </a>
            @endif



        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{request()->role}}s </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Accounts</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>
                       {{ $dataTable->table() }}
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
                    url: "{{route('admin.user.change-status')}}",
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
