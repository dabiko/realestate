@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Properties
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
            <h4 class="mb-3 mb-md-0">Property</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('agent.property.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Property
                </button>
            </a>


        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Property</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Properties</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>


                                  @if($properties->Count() > 0)

                                      {{ $dataTable->table() }}

                                  @else
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Thumbnail</th>
                                                <th>Category</th>
                                                <th>Agent Name</th>
                                                <th>Status</th>
                                                <th>Video</th>
                                                <th>Low Price</th>
                                                <th>Max Price</th>
                                                <th>Type</th>
                                                <th>Tag</th>
                                                <th >Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <tr>
                                                      <td colspan="100%" style="text-align: center;">
                                                              <div class="alert alert-primary" role="alert">
                                                                  <i data-feather="alert-circle"></i>
                                                                  <strong>Oops No Data Available!!! </strong> Create property.. <a href="{{route('agent.property.create')}}">Here</a>
                                                              </div>
                                                      </td>
                                                  </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>

        // change property status
        $(document).ready(function (message){
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
                    url: "{{route('agent.property.change-status')}}",
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
                            window.setTimeout(function(){
                                location.reload();
                            } ,1000);
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

            $('body').on('click', '.approve-project', function (event){

                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('agent.property.check-approved')}}",
                    method: 'GET',
                    data: {
                        id: id,
                    },
                    success: function (data){
                        if(data.status === 'success'){
                            let textInfo = data.response === 1 ? 'Do you want to Deactivate this project' : 'Do you want to approve this project';
                            let cancelInfo =  data.response === 1 ? 'This project is still approved' : 'This project is still pending approval';
                            let confirmText =  data.response === 1 ? 'Yes, Deactivate !' : 'Yes, Approve !';

                            let successTitle =  data.response === 1 ? 'Deactivating Project' : 'Approving Project';
                            let successMessage =  data.response === 1 ? 'Deactivating in <b></b>' : 'Approving in <b></b>';

                            let isChecked =  data.response === 1 ? 'false' : 'true';

                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-inverse-success',
                                    cancelButton: 'btn btn-inverse-danger'
                                },
                                buttonsStyling: true
                            })

                            swalWithBootstrapButtons.fire({
                                title: 'Are you sure?',
                                text: textInfo,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: confirmText,
                                cancelButtonText: 'No, cancel!',
                                reverseButtons: true
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "{{route('agent.property.change-status')}}",
                                        method: 'PUT',
                                        data: {
                                            status: isChecked,
                                            id: id,
                                        },
                                        success: function (data){
                                            if(data.status === 'success'){
                                                let timerInterval
                                                Swal.fire({
                                                    title: successTitle,
                                                    html: successMessage,
                                                    timer: 2000,
                                                    timerProgressBar: true,
                                                    didOpen: () => {
                                                        Swal.showLoading()
                                                        const b = Swal.getHtmlContainer().querySelector('b')
                                                        timerInterval = setInterval(() => {
                                                            b.textContent = Swal.getTimerLeft()
                                                        }, 100)
                                                    },
                                                    willClose: () => {
                                                        clearInterval(timerInterval)
                                                    }
                                                }).then((result) => {
                                                    /* Read more about handling dismissals below */
                                                    if (result.dismiss === Swal.DismissReason.timer) {
                                                        console.log('I was closed by the timer')
                                                    }
                                                })
                                                window.setTimeout(function(){
                                                    location.reload();
                                                } ,3000);

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

                                } else if (
                                    result.dismiss === Swal.DismissReason.cancel
                                ) {
                                    swalWithBootstrapButtons.fire(
                                        'Cancelled',
                                         cancelInfo,
                                        'info'
                                    )
                                }
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
            });


            $('body').on('click', '.no_video', function (event){
                Swal.fire({
                    icon: 'warning',
                    title: 'No video available',
                    text: 'Upload a new video and add the link to this property',
                })
            });
        })

    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
