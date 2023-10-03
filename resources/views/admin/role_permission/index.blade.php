@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Roles in Permissions
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
            <h4 class="mb-3 mb-md-0">Roles in Permissions</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">

            <a href="{{route('admin.roles.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                    Roles in Permissions
                </button>
            </a>



        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles in Permissions</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Roles in Permissions</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>

                    @if($roles->Count() > 0)
                        <div class="table-responsive">
                            <table  class="table">
                                <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            @foreach($role->permissions as $permission)
                                                <span class="badge bg-danger">{{$permission->name}} <br></span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{route('admin.roles.permissions.edit',Crypt::encryptString($role->id))}}" class="btn btn-inverse-info">
                                                <i class='far fa-edit'></i>
                                            </a>

                                            <a  href="{{route('admin.roles.permissions.delete', Crypt::encryptString($role->id))}}" class="btn btn-inverse-danger delete-item">
                                                <i class='far fa-trash-alt'></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="100%" style="text-align: center;">
                                        <div class="alert alert-primary" role="alert">
                                            <i data-feather="alert-circle"></i>
                                            <strong>Oops No Data Available!!! </strong> Create Roles in permission <a href="{{route('admin.roles.create')}}">Here</a>                                        </div>
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

        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                // validate form on keyup and submit
                $("#roleForm").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                    },

                    messages: {
                        name: {
                            required: "Name is required",
                        },

                    },
                    errorPlacement: function(error, element) {
                        error.addClass( "invalid-feedback" );

                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        }
                        else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                            error.insertAfter(element.parent().parent());
                        }
                        else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.appendTo(element.parent().parent());
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                        }
                    },
                    unhighlight: function(element, errorClass) {
                        if ($(element).prop('type') !== 'checkbox' && $(element).prop('type') !== 'radio') {
                            $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                        }
                    }
                });
            });
        });
    </script>
@endpush
