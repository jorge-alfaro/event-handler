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
{{--                @if (session('status'))--}}
{{--                    <div class="alert alert-dismissible alert-success">--}}
{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>--}}
{{--                        <strong> {{ session('status') }}</strong>--}}
{{--                    </div>--}}
{{--                @endif--}}
                <div class="card mt-2">
                    <div class="card-header">Lista de eventos</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach( Event::all() as $event)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $event->name }}
                                    <span
                                        class="badge bg-primary rounded-pill">{{( $event->status === true) ? 'Activo' : 'Inactivo'  }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <form method="POST" action="{{ route('events.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="event_id" class="form-label mt-4">Cambia el estatus del evento..</label>
                        <div class="d-flex">
                            <select class="form-select" id="event_id" name="event_id">
                                @if(count(Event::all()) == 0)
                                    <option value="">No hay eventos creados</option>
                                @endif
                                @foreach(Event::all() as $eve)
{{--                                    //Active the status TODO--}}
                                    <option value="{{ $eve->id }}">{{$eve->name}} @if($event->status) OKO @endif</option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-danger" type="submit">Cambiar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
