<div class="col-lg-8 col-md-12 col-sm-12 content-side">
    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">

                <div class="lower-content">
                    <h3>Update Password</h3>
                    <hr>

                    <form

                        action="{{route('user.password.update')}}"
                        method="POST"
                        class="default-form"
                    >

                        @csrf
                        @method('PATCH')


                        <div class="form-group">
                            <label for="current_password">{{__('Current Password')}}</label>
                            <input class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password" id="current_password">
                            @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{__('New Password')}}</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group message-btn">
                            <button type="submit" class="theme-btn btn-one"> {{__('Update')}}</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>

    </div>

</div>
