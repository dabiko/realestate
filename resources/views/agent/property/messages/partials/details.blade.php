<div class="col-lg-9">
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom tx-16">
        <div class="d-flex align-items-center">
            <i data-feather="star" class="text-primary icon-lg me-2"></i>
            <span>Property Inquiries</span>
        </div>
        <div>
            <a class="me-2" type="button" data-bs-toggle="tooltip" data-bs-title="Forward"><i data-feather="share" class="text-muted icon-lg"></i></a>
            <a class="me-2" type="button" data-bs-toggle="tooltip" data-bs-title="Print"><i data-feather="printer" class="text-muted icon-lg"></i></a>
            <a type="button" data-bs-toggle="tooltip" data-bs-title="Delete"><i data-feather="trash" class="text-muted icon-lg"></i></a>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between flex-wrap px-3 py-2 border-bottom">
        <div class="d-flex align-items-center">
            <div class="me-2">
                <img src="{{asset(!empty($details->user->photo) ? $details->user->photo : url('upload/no_image.jpg'))}}" alt="Avatar" class="rounded-circle img-xs">
            </div>
            <div class="d-flex align-items-center">
                <a href="#" class="text-body">{{$details->user->name}}</a>
                <span class="mx-2 text-muted">to</span>
                <a href="#" class="text-body me-2">me</a>
                <div class="actions dropdown">
                    <a href="#" data-bs-toggle="dropdown"><i data-feather="chevron-down" class="icon-lg text-muted"></i></a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="#">Mark as read</a>
                        <a class="dropdown-item" href="#">Mark as unread</a>
                        <a class="dropdown-item" href="#">Spam</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="#">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="tx-13 text-muted mt-2 mt-sm-0">{{date_format($details->created_at, 'l M d h:i A')}}</div>
    </div>
    <div class="p-4 border-bottom">
        {{$details->message}}
    </div>
    <div class="p-3">
        <div class="mb-3 text-center"><h4>Customer Info</h4></div>
        <div class="table-responsive">
            <table class="table table-hover">

                <tbody>
                <tr>
                    <th><b>Name : </b></th>
                    <td>{{$details->user->name}}</td>
                </tr>
                <tr>
                    <th><b>Email : </b></th>
                    <td>{{$details->user->email}}</td>
                </tr>
                <tr>
                    <th><b>Phone : </b></th>
                    <td>{{empty(!$details->user->phone) ? $details->user->phone : 'Not Provided'}}</td>
                </tr>
                <tr>
                    <th><b>Property Name : </b></th>
                    <td>{{$details->property->name}}</td>
                </tr>
                <tr>
                    <th><b>Property Code : </b></th>
                    <td>{{$details->property->code}}</td>
                </tr>
                <tr>
                    <th><b>Purpose : </b></th>
                    @if($details->property->purpose === 'rent')
                        <td><span class="badge bg-primary">{{strtoupper($details->property->purpose)}}</span></td>
                    @elseif($details->property->purpose === 'buy')
                        <td><span class="badge bg-info">{{strtoupper($details->property->purpose)}}</span></td>
                    @elseif($details->property->purpose === 'sale')
                        <td><span class="badge bg-success">{{strtoupper($details->property->purpose)}}</span></td>
                    @else
                        <td><span class="badge bg-danger">Error</span></td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
