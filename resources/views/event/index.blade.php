@php use App\Models\Event; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary rounded-start" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventCreate" aria-controls="offcanvasEventCreate">Crear
                        </button>
                        <button type="button" class="btn btn-secondary me-1 ms-1" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventEdit" aria-controls="offcanvasEventEdit">Edita
                        </button>
                        <button type="button" class="btn btn-secondary rounded-end" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventDelete" aria-controls="offcanvasEventDelete">Elimina
                        </button>
                    </div>
                </div>
                <!--Canvas create -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasEventCreate"
                     aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Evento</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-brands fa-get-pocket"></i>  Agrega un evento</div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('events.store') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="name"
                                                           class="col-md-4 col-form-label text-md-end">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="name"
                                                               placeholder="Ejemplo fiesta de cumpleaños"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-success">
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
                <!--Canvas Edit -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasEventEdit"
                     aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Evento</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-solid fa-wand-magic-sparkles"></i>  Edita un evento</div>
                                        <div class="card-body">
                                            <!--foreach TODO-->
                                            <form method="POST" action="{{ route('events.create') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name" value="" required
                                                                   placeholder="Ejemplo fiesta de cumpleaños"
                                                                   aria-label="Ejemplo fiesta de cumpleaños"
                                                                   aria-describedby="button-addon2">
                                                            <button class="btn btn-success" type="button"
                                                                    id="button-addon2">Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--endforeach -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Canvas Delete -->
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasEventDelete"
                     aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Evento</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                             // Contenido
                        </div>
                    </div>
                </div>

                <!-- Inicio -->
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
                <div class="card border-danger mb-3 mt-3">
                    <div class="card-header">Cambia el estatus del evento.</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('events.change') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <div class="d-flex">
                                    <select class="form-select" id="event_id" name="event_id">
                                        @if(count(Event::all()) == 0)
                                            <option value="">No hay eventos creados</option>
                                        @endif
                                        @foreach(Event::all() as $eve)
                                            @if($eve->status === true)
                                                <option selected class="text-success" value="{{ $eve->id }}">{{$eve->name}} - Active</option>
                                            @else
                                                <option value="{{ $eve->id }}">{{$eve->name}} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-danger" type="submit">Cambiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
