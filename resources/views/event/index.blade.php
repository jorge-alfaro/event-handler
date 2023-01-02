@php use App\Models\Event; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <a href="{{ route('events.create') }}">
                        <button type="button" class="btn btn-light">Agregar un evento</button>
                    </a>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">

                    </div>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong> {{ session('status') }}</strong>
                    </div>
                @endif
                <div class="card mt-2">
                    <div class="card-header">Lista de eventos</div>
                    <div class="card-body">
                        <ul class="list-group">
                            {{--                            {{ $events = Event::all() }}--}}
                            @foreach( Event::all() as $event)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $event->name }}
                                    <span
                                        class="badge bg-primary rounded-pill">{{( $event->status === 1) ? 'Activo' : 'Inactivo'  }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form action="{{ route('events.update') }}">
                    @csrf
                    <div class="form-group">
                        <label for="event_id" class="form-label mt-4">Cambia el estatus del evento..</label>
                        <select class="form-select" id="event_id">
                            @foreach(Event::all() as $eve)
                                <option value="{{ $eve->id }}">{{$eve->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-outline-danger" type="submit">Cambiar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
