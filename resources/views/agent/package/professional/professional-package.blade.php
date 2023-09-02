@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Professional Packages
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



    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.packages')}}">Packages </a></li>
            <li class="breadcrumb-item active" aria-current="page">Professional</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                            <a href="#" class="noble-ui-logo logo-light d-block mt-3">Ho<span>mes</span></a>
                            <p class="mt-1 mb-1"><b>Homes Invoice</b></p>
                            <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
                            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                            <p>{{$agent->name}}<br>{{$agent->address}}<br></p>
                        </div>
                        <div class="col-lg-3 pe-0">
                            <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
                            <h6 class="text-end mb-5 pb-4"># INV-002308</h6>
                            <p class="text-end mb-1">Balance Due</p>
                            <h4 class="text-end fw-normal">$ 50.00</h4>
                            <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span> {{date('d-m-Y')}}</h6>
                            <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> 12th Jul 2022</h6>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Package name </th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Unit cost</th>
                                    <th class="text-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-end">
                                    <td class="text-start">1</td>
                                    <td class="text-start">Professional</td>
                                    <td>10</td>
                                    <td>$50</td>
                                    <td>$50</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 w-100">
                        <div class="row">
                            <div class="col-md-6 ms-auto">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">$ 50.00</td>
                                        </tr>
                                        <tr>
                                            <td>TAX (12%)</td>
                                            <td class="text-end">$ 0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-800">Total</td>
                                            <td class="text-bold-800 text-end"> $ 50 .00</td>
                                        </tr>
                                        <tr>
                                            <td>Payment Made</td>
                                            <td class="text-danger text-end">(-) $ 50.00</td>
                                        </tr>
                                        <tr class="bg-dark">
                                            <td class="text-bold-800">Balance Due</td>
                                            <td class="text-bold-800 text-end">$ 50.00</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid w-100">
                        <a href="{{route('agent.process.professional')}}" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Buy Package</a>
                        <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
