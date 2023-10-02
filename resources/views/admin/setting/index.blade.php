@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} |  Settings
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
            <h4 class="mb-3 mb-md-0"> Homes Settings</h4>
        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Settings </li>
        </ol>
    </nav>


    <div class="row">
        <div class="col-5 col-md-3 pe-0">
            <div class="nav nav-tabs nav-tabs-vertical" id="v-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-home-tab" data-bs-toggle="pill" href="#v-home" role="tab" aria-controls="v-home" aria-selected="true">SMTP</a>

                <a class="nav-link" id="v-profile-tab" data-bs-toggle="pill" href="#v-profile" role="tab" aria-controls="v-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="v-messages-tab" data-bs-toggle="pill" href="#v-messages" role="tab" aria-controls="v-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-settings-tab" data-bs-toggle="pill" href="#v-settings" role="tab" aria-controls="v-settings" aria-selected="false">Settings</a>
            </div>
        </div>
        <div class="col-7 col-md-9 ps-0">
            <div class="tab-content tab-content-vertical border p-3" id="v-tabContent">
                <div class="tab-pane fade show active" id="v-home" role="tabpanel" aria-labelledby="v-home-tab">
                    <h6 class="mb-5 text-center">SMTP SETTINGS</h6>
                    <form
                        method="POST"
                        action="{{route('admin.settings-update.email')}}">

                        @csrf
                        @method('POST')

                        <input type="hidden" class="form-control" name="update_id" id="update_id" value="{{Crypt::encryptString(1)}}">


                        <div class="form-group mb-3">
                            <label  class="mb-1" for="mailer">{{__('MAIL_MAILER')}}</label>
                            <input type="text" class="form-control @error('mailer') is-invalid @enderror" name="mailer" id="mailer" value="{{$emailSetting->mailer}}">
                            @error('mailer')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label  class="mb-1" for="host">{{__('MAIL_HOST')}}</label>
                            <input type="text" class="form-control @error('host') is-invalid @enderror" name="host" id="host" value="{{$emailSetting->host}}">
                            @error('host')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label  class="mb-1" for="port">{{__('MAIL_PORT')}}</label>
                            <input type="text" class="form-control @error('port') is-invalid @enderror" name="port" id="port" value="{{$emailSetting->port}}">
                            @error('port')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label  class="mb-1" for="username">{{__('MAIL_USERNAME')}}</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{$emailSetting->username}}">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label  class="mb-1" for="mail_password">{{__('MAIL_PASSWORD')}}</label>
                            <input type="text" class="form-control @error('mail_password') is-invalid @enderror" name="mail_password" id="mail_password" value="{{$emailSetting->password}}">
                            @error('mail_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label  class="mb-1" for="encryption">{{__('MAIL_ENCRYPTION')}}</label>
                            <input type="text" class="form-control @error('encryption') is-invalid @enderror" name="encryption" id="encryption" value="{{$emailSetting->encryption}}">
                            @error('encryption')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label  class="mb-1" for="address">{{__('MAIL_FROM_ADDRESS')}}</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{$emailSetting->from_address}}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <button type="submit" class="btn btn-primary">
                            <i class="btn-icon-prepend" data-feather="upload"></i>  {{__('Update')}}
                        </button>

                    </form>

                </div>


                <div class="tab-pane fade" id="v-profile" role="tabpanel" aria-labelledby="v-profile-tab">
                    <h6 class="mb-1">Profile</h6>
                    <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing
                        exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna
                        consequat voluptate minim amet aliquip ipsum aute laboris nisi.</p>
                </div>
                <div class="tab-pane fade" id="v-messages" role="tabpanel" aria-labelledby="v-messages-tab">
                    <h6 class="mb-1">Messages</h6>
                    <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing
                        exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna
                        consequat voluptate minim amet aliquip ipsum aute laboris nisi.</p>
                </div>
                <div class="tab-pane fade" id="v-settings" role="tabpanel" aria-labelledby="v-settings-tab">
                    <h6 class="mb-1">Settings</h6>
                    <p>Nulla est ullamco ut irure incididunt nulla Lorem Lorem minim irure officia enim reprehenderit. Magna duis labore cillum sint adipisicing
                        exercitation ipsum. Nostrud ut anim non exercitation velit laboris fugiat cupidatat. Commodo esse dolore fugiat sint velit ullamco magna
                        consequat voluptate minim amet aliquip ipsum aute laboris nisi.</p>
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
@endpush
