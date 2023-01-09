@php use App\Models\Event; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary rounded-start" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventCreate" aria-controls="offcanvasEventCreate">Agregar
                        </button>
                        <button type="button" class="btn btn-primary me-1 ms-1" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventEdit" aria-controls="offcanvasEventEdit">Editar
                        </button>
                        <button type="button" class="btn btn-primary rounded-end" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasEventDelete" aria-controls="offcanvasEventDelete">Eliminar
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
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-brands fa-get-pocket"></i> Agrega un
                                            evento
                                        </div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('events.store') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="name"
                                                           class="col-md-12 col-form-label text-md-start">Nombre</label>
                                                    <div class="col-md-12">
                                                        <input id="name" type="text" class="form-control" name="name"
                                                               placeholder="Ejemplo fiesta de cumpleaños"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-success">
                                                            Agregar
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
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-solid fa-wand-magic-sparkles"></i> Edita
                                            un evento
                                        </div>
                                        <div class="card-body">
                                            <!--foreach -->

                                                <form method="POST" action="{{ route('events.update') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12 col-form-label text-md-start">
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input type="hidden" value="{{ $eventActive->id }}"
                                                                       name="edit_id">
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name" value="{{ $eventActive->name }}"
                                                                       required
                                                                       placeholder="Ejemplo fiesta de cumpleaños"
                                                                       aria-label="Ejemplo fiesta de cumpleaños"
                                                                       aria-describedby="button-addon2">
                                                                <button class="btn btn-success" type="submit"
                                                                        id="button-addon2">Actualizar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                        </div>
                                    </div>
                                    <div class="accordion mt-3" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                    Eventos antiguos
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                 aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @forelse ($eventInactive as $eventActive)
                                                        <form method="POST" action="{{ route('events.update') }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <input type="hidden"
                                                                               value="{{ $eventActive->id }}"
                                                                               name="edit_id">
                                                                        <input type="text" class="form-control"
                                                                               id="name"
                                                                               name="name"
                                                                               value="{{ $eventActive->name }}"
                                                                               required
                                                                               placeholder="Ejemplo fiesta de cumpleaños"
                                                                               aria-label="Ejemplo fiesta de cumpleaños"
                                                                               aria-describedby="button-addon2">
                                                                        <button class="btn btn-success" type="submit"
                                                                                id="button-addon2">Actualizar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @empty
                                                        <p class="text-bg-danger">No hay eventos.</p>
                                                    @endforelse

                                                </div>
                                            </div>
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
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong><i class="fa-solid fa-calendar-xmark"></i></strong> <a href="#" class="alert-link">se está valorando, si
                                    es buena idea eliminar</a> un evento.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inicio -->
                <div class="card mt-2">
                    <div class="card-header">Lista de eventos</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse ($events as $event)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $event->name }}
                                    <span
                                        class="badge bg-primary rounded-pill">{{( $event->status === true) ? 'Activo' : 'Inactivo'  }}</span>
                                </li>
                            @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center" value="">
                                    No hay eventos creados
                                </li>
                            @endforelse
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
                                        @forelse ($events as $eve)
                                            @if($eve->status === true)
                                                <option selected class="text-success"
                                                        value="{{ $eve->id }}">{{$eve->name}} - Activo
                                                </option>
                                            @else
                                                <option value="{{ $eve->id }}">{{$eve->name}} </option>
                                            @endif
                                        @empty
                                            <option value="">No hay eventos creados</option>
                                        @endforelse

                                    </select>
                                    <button class="btn btn-outline-danger ms-2" type="submit">Cambiar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
