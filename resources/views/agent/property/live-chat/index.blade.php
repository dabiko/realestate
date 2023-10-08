@extends('agent.layout.master')
@section('title')
    {{ config('app.name') }} | Live Chats
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
            <h4 class="mb-3 mb-md-0">Live Chats</h4>
        </div>
    </div>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Live Chats</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chats</h5>
                    <p class="text-muted mb-3">Add read text here.....</p>
                    <div id="app">
                        <chat-messages></chat-messages>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
