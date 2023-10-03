@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Roles
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
            <h4 class="mb-3 mb-md-0">Roles</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">

            <a  data-bs-toggle="modal" data-bs-target="#importModal" data-bs-whatever="@mdo">
                <button type="button" class="btn btn-outline-success btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="upload"></i>
                    Import
                </button>
            </a>

            <a href="{{route('admin.export.permissions')}}">
                <button type="button" class="btn btn-outline-info btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="download"></i>
                    Export
                </button>
            </a>


            <a data-bs-toggle="modal" data-bs-target="#roleModal" data-bs-whatever="@mdo">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Roles
                </button>
            </a>

            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">IMPORT PERMISSIONS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">

                            <form
                                id="uploadForm"
                                action="{{route('admin.import.permissions')}}"
                                method="POST"
                                enctype="multipart/form-data"

                            >
                                @csrf
                                @method('POST')

                                <div class="mb-3">
                                    <label for="import" class="form-label">Xlsx File Import</label>
                                    <input type="file" class="form-control  @error('import') is-invalid @enderror" id="import" name="import">
                                    @error('import')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-inverse-danger" data-bs-dismiss="modal">
                                        <i class="btn-icon-prepend" data-feather="cancel"></i>
                                        {{__('Close')}}
                                    </button>
                                    <button type="submit" class="btn btn-inverse-primary">
                                        <i class="btn-icon-prepend" data-feather="server"></i>
                                        {{__('Import')}}
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importModalLabel">ROLES</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">

                            <form
                                id="roleForm"
                                action="{{route('admin.roles.store')}}"
                                method="POST"

                            >
                                @csrf
                                @method('POST')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-inverse-danger" data-bs-dismiss="modal">
                                        <i class="btn-icon-prepend" data-feather="cancel"></i>
                                        {{__('Close')}}
                                    </button>
                                    <button type="submit" class="btn btn-inverse-primary">
                                        <i class="btn-icon-prepend" data-feather="server"></i>
                                        {{__('Save')}}
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Roles</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>

                    @if($roles->Count() > 0)
                        {{ $dataTable->table() }}
                    @else
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr><th>Num</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="100%" style="text-align: center;">
                                        <div class="alert alert-primary" role="alert">
                                            <i data-feather="alert-circle"></i>
                                            <strong>Oops No Data Available!!! </strong> Create Roles.. <a href="{{route('admin.roles.create')}}">Here</a>                                        </div>
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
