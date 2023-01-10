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
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Producto</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-brands fa-get-pocket"></i> Agrega un
                                            producto
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('products.store') }}">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="event_id"
                                                           class="col-md-12 col-form-label text-md-start">Evento</label>
                                                    <div class="col-md-12">
                                                        <select required class="form-select" id="event_id"
                                                                name="event_id">
                                                            @forelse ($events as $event)
                                                                @if($event->status)
                                                                    <option selected
                                                                            value="{{ $event->id }}">{{ $event->name }}
                                                                        - Activo
                                                                    </option>
                                                                @else
                                                                    <option
                                                                        value="{{ $event->id }}">{{ $event->name }}</option>
                                                                @endif
                                                            @empty
                                                                <option value="">Selecciona un evento</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="name" class="col-md-12 col-form-label text-md-start">Nombre</label>
                                                    <div class="col-md-12">
                                                        <input id="name" type="text" class="form-control" name="name"
                                                               value="{{ old('name') }}" required autocomplete="name"
                                                               autofocus placeholder=" ejem. Carne asada">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="price" class="col-md-12 col-form-label text-md-start">Precio</label>
                                                    <div class="col-md-12">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">$</span>
                                                            <input id="price" type="text" class="form-control"
                                                                   name="price"
                                                                   value="{{ old('price') }}" required
                                                                   autocomplete="price" autofocus placeholder="100">
                                                        </div>
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
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Producto</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="">
                                    <div class="card">
                                        <div class="card-header"><i class="fa-solid fa-wand-magic-sparkles"></i> Edita
                                            un producto
                                        </div>
                                        <div class="card-body">
                                            <!--for else -->
                                            @forelse ($products as $productEdit)
                                                <form method="POST"
                                                      action="{{ route('products.update',$productEdit->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-md-12 col-form-label text-md-start">
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="name"
                                                                       name="name" value="{{ $productEdit->name }}"
                                                                       required
                                                                       placeholder="Ejemplo fiesta de cumpleaños"
                                                                       aria-label="Ejemplo fiesta de cumpleaños"
                                                                       aria-describedby="button-addon2">

                                                                <input id="price" type="number" class="form-control"
                                                                       name="price"
                                                                       value="{{ ($productEdit->price) ? :old('price') }}" required
                                                                       autocomplete="price" autofocus placeholder="100">
                                                                <button class="btn btn-success" type="submit"
                                                                        id="button-addon2">Actualizar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @empty
                                                <p>No hay productos.</p>
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
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Producto</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="card mt-2">
                            <div class="card-header">Lista de productos</div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @forelse ($products as $product)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="">{{ $product->name }}</div>
                                                <form method="POST"
                                                      action="{{ route('products.destroy',$product->id)  }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </form>
                                            </div>
                                        </li>
                                    @empty
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">No hay productos registrados</li>
                                        </ul>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Inicio Lista Principal  -->
                <div class="card mt-2">
                    <div class="card-header">Lista de productos en el evento <strong> {{ $eventName }}</strong></div>
                    <div class="card-body">
                        <ul class="list-group">
                            @forelse ($products as $product)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-success">
                                            <i class="fa-regular fa-money-bill-1"></i> <span class="text-white">{{ $product->name }}</span>
                                            <i class="fa-solid fa-arrow-right text-danger"></i>
                                            <strong> $ {{ $product->price }}</strong>
                                        </div>

                                    </div>
                                </li>
                            @empty
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">No hay productos registrados</li>
                                </ul>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
