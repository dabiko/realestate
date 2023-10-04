@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$role->name}} Permissions
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
            <h4 class="mb-3 mb-md-0">Edit <code>{{$role->name}} </code> Role in Permissions</h4>
        </div>

        <a href="{{route('admin.roles-permissions.index')}}">
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="arrow-left"></i>
                Roles in Permissions Table
            </button>
        </a>
    </div>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><code>{{$role->name}} </code> Role in Permissions</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Roles in Permissions</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>

                    <form id="rolesPermissionsForm"
                          method="POST" action="{{route('admin.roles-permissions.update', Crypt::encryptString($role->id))}}">

                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <h5>Role : <code>{{$role->name}}</code></h5>
                        </div>

                        <div class="mb-3">
                            <label for="checkDefaultMain" class="form-label">{{ __('All Permissions') }}</label>
                            <input type="checkbox" name="" class="form-check-input checkDefaultMain" id="checkDefaultMain">
                            @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Update')}}
                        </button>

                        <hr>

                        @foreach($permission_groups as $groups)
                            <div class="row">
                                <div class="col-md-3">
                                    @php
                                        $permissions_sub = \App\Models\User::getPermissionByGroupName($groups->group_name)
                                    @endphp

                                    <div class="form-check mb-2">
                                        <label for="checkDefault" class="form-label">{{ $groups->group_name }}</label>
                                        <input type="checkbox" name="" class="form-check-input" id="checkDefault"
                                            {{\App\Models\User::roleHasPermissions($role,$permissions) ? 'checked' : ''}}
                                        >
                                        @error('permissions')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    @foreach($permissions_sub as $permission)
                                        <div class="form-check mb-2">
                                            <label for="checkDefault{{$permission->id}}" class="form-label">{{ $permission->name }}</label>
                                            <input type="checkbox" name="permission[]" class="form-check-input" id="checkDefault{{$permission->id}}" value="{{$permission->id}}"
                                                   {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                            >
                                            @error('permission')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endforeach
                                    <br> <hr>
                                </div>
                            </div>
                        @endforeach
                        <hr>
                        <div class="mb-3">
                            <label for="checkDefaultMain" class="form-label">{{ __('All Permissions') }}</label>
                            <input type="checkbox" name="" class="form-check-input checkDefaultMain" id="checkDefaultMain">
                            @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Update')}}
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
            })
        })
    </script>
@endpush
