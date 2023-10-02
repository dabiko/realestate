<div class="col-lg-9">
    <div class="p-3 border-bottom">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="d-flex align-items-end mb-2 mb-md-0">
                    <i data-feather="inbox" class="text-muted me-2"></i>
                    <h4 class="me-1">Inbox</h4>
                    <span class="text-muted">({{count($tour_messages)}} new messages)</span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search mail...">
                    <button class="btn btn-light btn-icon" type="button" id="button-search-addon"><i data-feather="search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="email-list">
        @if(count($tour_messages) > 0)
            @foreach($tour_messages as $messages)
                <div class="email-list-item email-list-item--unread">
                    <div class="email-list-actions">

                        <a class="favorite" href="javascript:(0);"><span><i data-feather="star"></i></span></a>
                    </div>
                    <a href="{{route('agent.property-schedules.details', Crypt::encryptString($messages->id))}}" class="email-list-detail">
                        <div class="content">
                            <span class="from">{{$messages->user->name}}</span>
                            <div>
                                <p class="msg">{{$messages->date}}</p>
                                <p class="msg">{{$messages->time}}</p>
                                <p class="msg">{{$messages->message}}</p>
                            </div>

                        </div>
                        <span class="date">{{date_format($messages->created_at, 'l M d h:i A')}}</span>
                    </a>
                </div>
            @endforeach
        @else
            <div class="alert alert-primary text-center" role="alert">
                <i data-feather="alert-circle"></i>
                <b> Empty Inbox !!. You have no scheduled tours </b>
            </div>
        @endif
    </div>
</div>
