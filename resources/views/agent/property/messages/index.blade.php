@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | messages
@endsection

@section('content')
    <div class="row inbox-wrapper">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 border-end-lg">
                            <div class="d-flex align-items-center justify-content-between">
                                <button class="navbar-toggle btn btn-icon border d-block d-lg-none" data-bs-target=".email-aside-nav" data-bs-toggle="collapse" type="button">
                                    <span class="icon"><i data-feather="chevron-down"></i></span>
                                </button>
                                <div class="order-first">
                                    <h4>Mail Service</h4>
                                    <p class="text-muted">support-homes@gmail.com</p>
                                </div>
                            </div>
                            <div class="d-grid my-3">
                                <a class="btn btn-primary" href="./compose.html">Compose Email</a>
                            </div>
                            <div class="email-aside-nav collapse">
                                <ul class="nav flex-column">
                                    <li class="nav-item active">
                                        <a class="nav-link d-flex align-items-center" href="{{route('agent.property.message')}}">
                                            <i data-feather="inbox" class="icon-lg me-2"></i>
                                            Inbox
                                            <span class="badge bg-danger fw-bolder ms-auto">{{$count}}
                                        </a>
                                    </li>

                                </ul>
                                <p class="text-muted tx-12 fw-bolder text-uppercase mb-2 mt-4">Labels</p>
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="#">
                                            <i data-feather="tag" class="text-warning icon-lg me-2"></i>
                                            Important
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="#">
                                            <i data-feather="tag" class="text-primary icon-lg me-2"></i>
                                            Business
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" href="#">
                                            <i data-feather="tag" class="text-info icon-lg me-2"></i>
                                            Inspiration
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if (Route::currentRouteName() === 'agent.property.message')
                            @include('agent.property.messages.partials.messages')
                        @elseif(Route::currentRouteName() === 'agent.message.details')
                            @include('agent.property.messages.partials.details')
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
