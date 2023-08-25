<div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card rounded">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <h4>Update Profile</h4>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="mt-3 alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="card-body">

                    <form
                        action="{{route('admin.profile.update')}}"
                        method="POST"
                        class="forms-sample"
                        enctype="multipart/form-data"
                    >

                        @csrf
                        @method('PUT')

                        <h5 class="mb-2">Preview</h5>
                        <div class="d-flex align-items-center mb-3">
                            <img id="show-image" class="wd-90 rounded-circle" src="{{ (empty(!$profile->photo)) ? asset($profile->photo) : url('upload/no_image.jpg')}}" alt="">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{__('Profile Image')}}</label>
                            <input type="file" class="form-control" id="image" name="image" autocomplete="off">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$profile->name}}" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="username" class="form-label">{{__('Username')}}</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{$profile->username}}" autocomplete="off">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">{{__('Phone')}}</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{$profile->phone}}" autocomplete="off">
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label">{{__('Address')}}</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{$profile->address}}" autocomplete="off">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">
                            <i data-feather="upload"></i> Update
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
