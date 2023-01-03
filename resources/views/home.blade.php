@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}   {{ __('You are logged in!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3 class="">{{ $greetings }} - {{ date('d-m-Y')  }}</h3>

                </div>
                <div>
                    <div class="list-group">
                        <a href="{{ route('main') }}" class="list-group-item list-group-item-action flex-column align-items-start active">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Evento activo</h5>
                                <small>{{ $timeAgo }}</small>
                            </div>
                            <p class="mb-1 text-warning">{{ $eventName }}</p>
                            <small><i class="fa-solid fa-champagne-glasses"></i> {{ $countMembers }} miembros en este evento</small>
                        </a>
{{--                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">--}}
{{--                            <div class="d-flex w-100 justify-content-between">--}}
{{--                                <h5 class="mb-1">List group item heading</h5>--}}
{{--                                <small class="text-muted">3 days ago</small>--}}
{{--                            </div>--}}
{{--                            <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>--}}
{{--                            <small class="text-muted">Donec id elit non mi porta.</small>--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
            <p class="text-info">La cuenta hasta ahora: $ {{ $totalCheckEvent }}</p>
        </div>
    </div>
</div>
@endsection
