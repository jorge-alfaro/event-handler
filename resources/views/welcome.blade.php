@extends('layouts.app')

@push('scripts')
{{--    <script src="{{ asset('resources/js/welcome.js') }}" defer></script>--}}
    @vite('resources/js/welcome.js')
@endpush

@section('content')
    <div class="welcome d-flex align-items-center justify-content-center">
        <div class="text-center">
            <h1 class="shadow bg-dark">Organiza tus metas</h1>
            <a class="btn btn-lg btn-dark" href="{{ route('register') }}">Get Started</a>
        </div>
    </div>
@endsection
