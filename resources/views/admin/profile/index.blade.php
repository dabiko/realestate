@php
    use Carbon\Carbon;
@endphp
@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Admin Profile
@endsection

@section('content')
    @if(Session::has('status'))
        <script>
            ToastToRight.fire({
                icon: '{{Session::get('status')}}',
                title: '{{Session::get('message')}}'
            })

        </script>
    @endif


    <div class="row profile-body">

        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img style="width:25%" class="rounded-circle" src="{{ (empty(!$profile->photo)) ? asset($profile->photo) : url('upload/no_image.jpg')}}" alt="">
                        <span class=" h4 ms-3">{{$profile->name}}</span>
                    </div>
                    <p>All I know is that I know nothing</p>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Joined :</label>
                        <p class="text-muted">{{Carbon::parse($profile->created_at)->diffForHumans()}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives :</label>
                        <p class="text-muted">{{$profile->address}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email :</label>
                        <p class="text-muted">{{$profile->email}}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone :</label>
                        <p class="text-muted">{{$profile->phone}}</p>
                    </div>

                    <div class="mt-3 d-flex social-links">
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="github"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="twitter"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                            <i data-feather="instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if ( Route::currentRouteName() === 'admin.profile')

            @include('admin.profile.partials.profileUpdate')

        @else

            @include('admin.profile.partials.passwordUpdate')

        @endif





    </div>
@endsection
@push('scripts')
    <script>

        $(document).ready(function () {
            $('#image').change(function (event) {

                let reader = new FileReader();

                reader.onload = function (event) {

                    $('#show-image').attr('src', event.target.result);

                }

                reader.readAsDataURL(event.target.files['0']);

            })
        })

    </script>
@endpush
