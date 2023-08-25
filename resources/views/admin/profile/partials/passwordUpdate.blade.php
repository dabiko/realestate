<div class="col-md-8 col-xl-8 middle-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card rounded">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <h4>Update Password</h4>
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
                        action="{{route('admin.password.update')}}"
                        method="POST"
                        class="forms-sample"
                    >

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">{{__('Current Password')}}</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="current-password">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{__('New Password')}}</label>
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
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
