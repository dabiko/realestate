<div class="col-lg-8 col-md-12 col-sm-12 content-side">
    <div class="blog-details-content">
        <div class="news-block-one">
            <div class="inner-box">

                <div class="lower-content">
                    <h3>Property Scheduled Tour Status</h3>


                    <table class="table table-striped">

                        @if(count($user_schedule) > 0)
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Property Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_schedule as $key => $tour)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$tour->property->name}}</td>
                                    <td>{{$tour->date}}</td>
                                    <td>{{$tour->time}}</td>
                                    <td>
                                        @if($tour->status === 1)
                                            <span class="badge rounded-pill bg-success">Confirmed</span>
                                        @else
                                            <span class="badge rounded-pill bg-warning">Confirmed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @else
                                <div colspan="100%" style="text-align: center;" class="alert alert-primary" role="alert">
                                    <i data-feather="alert-circle"></i>
                                    <strong>You have not scheduled to visit any property yet!! </strong>
                                </div>
                        @endif

                    </table>


                </div>
            </div>
        </div>

    </div>

</div>
