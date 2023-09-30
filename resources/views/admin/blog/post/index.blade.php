@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | Blog Post Dashboard
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
            <h4 class="mb-3 mb-md-0">Blog Post</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.blog-post.create')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                     Blog Post
                </button>
            </a>


        </div>
    </div>


    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Blog Post</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> Blog Posts</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>
                    @if($posts->Count() > 0)
                        {{ $dataTable->table() }}
                    @else
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                <tr>
                                    <th>Num</th>
                                    <th>Owner</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="100%" style="text-align: center;">
                                        <div class="alert alert-primary" role="alert">
                                            <i data-feather="alert-circle"></i>
                                            <strong>Oops No Data Available!!! </strong> Create categories.. <a href="{{route('admin.blog-category.create')}}">Here</a>                                        </div>
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
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
                    url: "{{route('admin.blog_post.change-status')}}",
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
