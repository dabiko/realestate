@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Packages
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
            <h4 class="mb-3 mb-md-0">Packages</h4>
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
            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">Dashboard </a></li>
            <li class="breadcrumb-item active" aria-current="page">Packages</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-3 mt-4">Choose a plan</h3>
                    <p class="text-muted text-center mb-4 pb-2">Choose the features and functionality your properties need today. Easily upgrade as your needs grows.</p>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Basic</h4>
                                        <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$0</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Limited</p>
                                        <h5 class="text-primary text-center mb-4">Up to 1 Property</h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td><p>1 Property</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td><p>Invoicing</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td><p>1-Hour Customer Service daily</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                                <td><p class="text-muted">1-Hour response time</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                                <td><p class="text-muted">Free training (2-Hours Daily)</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                                <td><p class="text-muted">Premium apps</p></td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            @if($agent->credit === 0 || $agent->credit === 1)
                                                <a class="btn btn-primary mt-4"> Current Package</a>
                                            @else
                                                <a class="btn btn-inverse-primary mt-4"> Buy Now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Business</h4>
                                        <i data-feather="gift" class="text-info icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$20</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Unlimited</p>
                                        <h5 class="text-info text-center mb-4">Up to 3 Properties</h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-info me-2"></i></td>
                                                <td><p>3 Properties</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-info me-2"></i></td>
                                                <td><p>Invoicing</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-info me-2"></i></td>
                                                <td><p>4-Hour Customer Service daily</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-info me-2"></i></td>
                                                <td><p>1-Hour response time</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-info me-2"></i></td>
                                                <td><p>Free training (2-Hours Daily)</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                                <td><p class="text-muted">Premium apps</p></td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            @if($agent->credit >= 3)

                                                <a class="btn btn-info mt-4"> Current Package</a>
                                            @else
                                                <a href="{{route('agent.buy.business')}}" class="btn btn-inverse-info mt-4"> Upgrade Now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">Professional</h4>
                                        <i data-feather="briefcase" class="text-success icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">$50</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Unlimited</p>
                                        <h5 class="text-success text-center mb-4">Up to 10 Properties</h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>10 Properties</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>Invoicing</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>Unlimited Customer Service support</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>1-Hour response time</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>Free training (3-Hours Daily)</p></td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-success me-2"></i></td>
                                                <td><p>Premium apps</p></td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            @if($agent->credit <= 6)

                                                <a class="btn btn-success mt-4"> Current Package</a>
                                            @else
                                                <a href="{{route('agent.buy.professional')}}" class="btn btn-inverse-success mt-4"> Upgrade Now</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush
