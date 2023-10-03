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
