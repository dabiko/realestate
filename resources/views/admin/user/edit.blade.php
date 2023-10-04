@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Edit {{$user->name}}
@endsection

@section('content')
    @if(Session::has('status'))
        <script>
            Swal.fire({
                icon: '{{Session::get('status')}}',
                title: '{{Session::get('message')}}',
                showConfirmButton: false,
                timer: 3000
            })
        </script>
    @endif

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Edit {{$user->name}}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.users.index', ['role' => $user->role])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                    {{$user->role}} Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.users.index', ['role' => $user->role])}}">{{$user->role}} Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$user->role}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                        <form
                            method="POST"
                            action="{{route('admin.users.update', Crypt::encryptString($user->id))}}">

                            @csrf
                            @method('PATCH')

                            <div class="form-group mb-3">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label  class="mb-1" for="email">{{__('Email')}}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}">
                                <input type="hidden" class="form-control @error('role') is-invalid @enderror" name="role" id="role" value="{{$user->role}}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">{{ __('Roles') }}</label>
                                <select class="js-example-basic-single form-select  @error('role_id') is-invalid @enderror" data-width="100%" name="role_id" id="role_id" >
                                    <option selected disabled>Update Role</option>
                                    @foreach($roles as $role)
                                        <option {{$user->hasRole($role->name) ? 'selected' : ''}} value="{{Crypt::encryptString($role->id)}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Update')}}
                            </button>

                        </form>
{{--                    @elseif(request()->role == 'User')--}}
{{--                        <p>No form provided</p>--}}
{{--                    @elseif(request()->role == 'Admin')--}}
{{--                        <p>No form provided</p>--}}
{{--                    @endif--}}


                </div>
            </div>
        </div>
    </div>

@endsection
