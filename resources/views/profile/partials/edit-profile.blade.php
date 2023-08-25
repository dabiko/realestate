<div class="col-lg-8 col-md-12 col-sm-12 content-side">
    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">

                <div class="lower-content">
                    <h3>Update your profile</h3>
                    <hr>

                    <form

                        action="{{route('user.profile.update')}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="default-form"
                    >

                        @csrf
                        @method('PATCH')

                        <h5 class="mb-2">{{__('Preview')}}</h5>
                        <div class="form-group">
                            <figure class="post-thumb">
                               <img style="width: 20%; height: 20%" id="show-image" class="wd-10 rounded-circle" src="{{ (empty(!$user->photo)) ? asset($user->photo) : url('upload/no_image.jpg')}}" alt="">
                            </figure>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">{{__('Profile Image')}}</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name">{{__('Name')}}</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{$user->name}}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">{{__('Username')}}</label>
                            <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" id="username" value="{{$user->username}}">
                            @error('username')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">{{__('Phone')}}</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" id="phone" value="{{$user->phone}}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">{{__('Address')}}</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{$user->address}}">
                            @error('address')
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
