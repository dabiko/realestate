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

                    <form id="rolesPermissionsForm"
                          method="POST" action="{{route('admin.roles-permissions.store')}}">

                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Roles') }}</label>
                            <select class="js-example-basic-single form-select  @error('role') is-invalid @enderror" data-width="100%" name="role" id="role" >
                                <option selected disabled>Select roles</option>
                                @foreach($roles as $role)
                                    <option value="{{Crypt::encryptString($role->id)}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="checkDefaultMain" class="form-label">{{ __('All Permissions') }}</label>
                            <input type="checkbox" name="permissions" class="form-check-input checkDefaultMain" id="checkDefaultMain">
                            @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Save')}}
                        </button>
                        <hr>

                        @foreach($permission_groups as $groups)
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check mb-2">
                                        <label for="checkDefault" class="form-label">{{ $groups->group_name }}</label>
                                        <input type="checkbox" name="" class="form-check-input" id="checkDefault">
                                        @error('permissions')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    @php
                                        $permissions_sub = \App\Models\User::getPermissionByGroupName($groups->group_name)
                                    @endphp

                                    @foreach($permissions_sub as $permission)
                                        <div class="form-check mb-2">
                                            <label for="checkDefault{{$permission->id}}" class="form-label">{{ $permission->name }}</label>
                                            <input type="checkbox" name="permission[]" class="form-check-input" id="checkDefault{{$permission->id}}" value="{{$permission->id}}">
                                            @error('permission')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                    <br> <hr>
                                </div>
                            </div>
                        @endforeach


                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Save')}}
                        </button>

                    </form>



                </div>
            </div>
        </div>
    </div>
@endsection
<style type="text/css">
    .form-check > label {
        text-transform: capitalize;
    }
</style>
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

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.checkDefaultMain', function (event){
                // event.preventDefault();

                let isChecked = $(this).is(':checked');

                if(isChecked){
                    $('input[ type=checkbox]').prop('checked', true);
                }else{
                    $('input[ type=checkbox]').prop('checked', false);
                }

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
