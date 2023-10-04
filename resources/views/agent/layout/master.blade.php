<!DOCTYPE html>
<html lang="en">
@include('agent.layout.header-scripts')
<script>
    const ToastToRight = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    const ToastCenter = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>
<body>
<div class="main-wrapper">

    @include('agent.layout.navigation')


    <div class="page-wrapper">

        @include('agent.layout.header')


        <div class="page-content">
            @php
                use \App\Models\User;
                use \Illuminate\Support\Facades\Auth;
                $status = User::findOrFail(Auth::id());
            @endphp
            @if($status->status == 1)
                @yield('content')
            @else
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
                    </div>
                    <button type="button" class="btn btn-inverse-warning btn-icon-text mb-2 mb-md-0">
                        <i class="fas fa-clock fa-spin"></i> &ensp;
                        Account is Inactive
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align: center" class="alert alert-danger" role="alert">
                                    <i data-feather="alert-circle"></i>
                                    <strong>An Admin will activate your profile. This usually takes 24 hours MAX.  </strong>  Thank You!!!
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>

        @include('agent.layout.footer')

    </div>
</div>
@include('agent.layout.footer-scripts')

</body>

@stack('scripts')
</html>

