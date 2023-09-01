@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Create {{request()->role}}
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
            <h4 class="mb-3 mb-md-0">Create a new {{request()->role}}</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.users.index', ['role' => request()->role])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                    {{request()->role}} Table
                </button>
            </a>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.users.index', ['role' => request()->role])}}">User Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{request()->role}}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if(request()->role == 'Agent')
                        <form method="POST" action="{{route('admin.users.store', ['role'=> 'Agent'])}}">

                            @csrf
                            @method('POST')

                            <div class="form-group mb-3">
                                <label  class="mb-1" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label  class="mb-1" for="email">{{__('Email')}}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{old('email')}}">
                                <input type="hidden" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="password">
                                <input type="hidden" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" value="password">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="btn-icon-prepend" data-feather="server"></i>  {{__('Create')}}
                            </button>

                        </form>
                    @elseif(request()->role == 'User')
                        <p>No form provided</p>
                    @elseif(request()->role == 'Admin')
                        <p>No form provided</p>
                    @endif


                </div>
            </div>
        </div>
    </div>

@endsection
