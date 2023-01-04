@php use App\Models\Event; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary rounded-start" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">Crear
                        </button>
                        <button type="button" class="btn btn-secondary me-1 ms-1">Edita</button>
                        <button type="button" class="btn btn-secondary rounded-end">Elimina</button>
                    </div>
                </div>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Evento</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">Agrega un evento</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('events.store') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="name"
                                                               placeholder="Ejemplo fiesta de cumpleaños"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Guardar
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
