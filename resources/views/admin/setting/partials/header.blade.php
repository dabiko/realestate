<div class="tab-pane fade" id="v-profile" role="tabpanel" aria-labelledby="v-profile-tab">
    <h6 class="mb-5 text-center">HEADER SETTINGS</h6>
    <form
        method="POST"
        action="{{route('admin.header-settings.update')}}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('POST')

        <input type="hidden" class="form-control" name="update_id" id="update_id" value="{{Crypt::encryptString(1)}}">

        <h5 class="mb-2">Logo Preview</h5>
        <div class="d-flex align-items-center mb-3">
            <img style="width: 10%; height: 10%" id="show-image" src="{{asset(empty(!$headerSetting->logo) ? $headerSetting->logo : url('upload/no_image.jpg'))}}" alt="">
        </div>

        <div class="col-md-12 mb-3">
            <label  class="mb-1" for="logo">{{__('Logo')}}</label>
            <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" id="logo" >
            @error('logo')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label  class="mb-1" for="address">{{__('Address')}}</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" value="{{$headerSetting->address}}">
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-md-6 mb-3">
                <label  class="mb-1" for="working_days">{{__('Working Days')}}</label>
                <input type="text" class="form-control @error('working_days') is-invalid @enderror" name="working_days" id="working_days" value="{{$headerSetting->working_days}}">
                @error('working_days')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>



        <div class="row  mb-3">
            <div class="form-group col-md-6">
                <label  class="mb-1" for="phone">{{__('Phone')}}</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{$headerSetting->phone}}">
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label  class="mb-1" for="facebook">{{__('Facebook')}}</label>
                <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" id="facebook" value="{{$headerSetting->facebook}}">
                @error('facebook')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">

            <div class="form-group col-md-6">
                <label  class="mb-1" for="twitter">{{__('Twitter')}}</label>
                <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" id="twitter" value="{{$headerSetting->twitter}}">
                @error('twitter')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label  class="mb-1" for="pinterest">{{__('Pinterest')}}</label>
                <input type="text" class="form-control @error('pinterest') is-invalid @enderror" name="pinterest" id="pinterest" value="{{$headerSetting->pinterest}}">
                @error('pinterest')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row mb-3" >
            <div class="form-group col-md-6">
                <label  class="mb-1" for="google">{{__('Google+')}}</label>
                <input type="text" class="form-control @error('google') is-invalid @enderror" name="google" id="google" value="{{$headerSetting->google}}">
                @error('google')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label  class="mb-1" for="vimeo">{{__('Vimeo')}}</label>
                <input type="text" class="form-control @error('vimeo') is-invalid @enderror" name="vimeo" id="vimeo" value="{{$headerSetting->vimeo}}">
                @error('vimeo')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>



        <button type="submit" class="btn btn-primary">
            <i class="btn-icon-prepend" data-feather="upload"></i>  {{__('Update')}}
        </button>

    </form>

</div>
@push('scripts')
    <script>

        $(document).ready(function () {
            $('#image').change(function (event) {

                let reader = new FileReader();

                reader.onload = function (event) {

                    $('#show-image').attr('src', event.target.result);

                };

                reader.readAsDataURL(event.target.files['0']);

            })
        })

    </script>
@endpush
