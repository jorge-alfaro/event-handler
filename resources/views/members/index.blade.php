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
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Miembro</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-brands fa-get-pocket"></i> Agrega un miembro
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('members.store') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="event_id" class="col-md-4 col-form-label text-md-end">Evento</label>
                                                    <div class="col-md-6">
                                                        <select required class="form-select" id="event_id" name="event_id">
                                                            @forelse ($events as $event)
                                                                @if($event->status)
                                                                <option selected value="{{ $event->id }}">{{ $event->name }} - Activo</option>
                                                                @else
                                                                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                                                                @endif
                                                            @empty
                                                                <option value="">Selecciona un evento</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="name"
                                                               value="{{ old('name') }}" required autocomplete="name" autofocus placeholder=" ejem. Pedro">
                                                    </div>
                                                </div>
                                                <div class="row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
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
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Miembro</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-solid fa-wand-magic-sparkles"></i> Edita
                                            un miembro
                                        </div>
                                        <div class="card-body">
                                            <!--for else -->
                                            @forelse ($members as $memberEdit)
                                                <form method="POST" action="{{ route('members.update',$memberEdit->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12 col-form-label text-md-start">
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input type="hidden" value="{{ $memberEdit->id }}"
                                                                       name="edit_id">
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name" value="{{ $memberEdit->name }}"
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
                                                <p>No hay miembros.</p>
                                            @endforelse
                                            <!--end for else -->
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
                                <strong>En construcción!</strong> <a href="#" class="alert-link">se está valorando, si
                                    es buena idea eliminar</a> un evento.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inicio -->
                <div class="card mt-2">
                    <div class="card-header">Lista de miembros</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse ($members as $member)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">{{ $member->name }}</div>
                                        <form method="POST" action="{{ route('members.destroy',$member->id)  }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">No hay miembros registrados</li>
                                </ul>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
