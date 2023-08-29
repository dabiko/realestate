@extends('admin.layout.master')
@section('title')
    {{ config('app.name') }} | {{$property->name}} Facility
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
            <h4 class="mb-3 mb-md-0">{{$property->name}} Facility</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('admin.property.index')}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="arrow-left-circle"></i>
                     Property Table
                </button>
            </a>

            <a href="{{route('admin.property-facility.create', ['property' => Crypt::encryptString($property->id)])}}">
                <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="plus-circle"></i>
                    Property facility
                </button>
            </a>


        </div>
    </div>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Facilities</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Facilities</h6>
                    <p class="text-muted mb-3">Add read text here.....</p>


                                  @if($property_facility->Count() > 0)

                                      {{ $dataTable->table() }}

                                  @else
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Property Name</th>
                                                <th>Image</th>
                                                <th >Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                  <tr>
                                                      <td colspan="100%" style="text-align: center;">
                                                              <div class="alert alert-primary" role="alert">
                                                                  <i data-feather="alert-circle"></i>
                                                                  <strong>Oops No Data Available!!! </strong> Add Gallery images
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

        $(document).ready(function (){

            $('#image').on('change', function(){
                if (window.File && window.FileReader && window.FileList && window.Blob)
                {
                    let data = $(this)[0].files;

                    $.each(data, function(index, file){
                        if(/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file.type)){
                            let fRead = new FileReader();
                            fRead.onload = (function(file){
                                return function(e) {
                                    let img = $('<img class="m-2" src="" alt="preview"/>').addClass('thumb').attr('src', e.target.result)
                                        .width(130)
                                        .height(80);
                                    $('#preview_img').append(img) ;
                                };
                            })(file);
                            fRead.readAsDataURL(file);
                        }
                    });

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Your browser does not support File API!',
                    })
                }
            });
        })

    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
