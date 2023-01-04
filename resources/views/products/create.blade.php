@php use App\Models\Event; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Agrega un producto</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
                            <div class="row mb-3">
                                    <label for="event_id" class="col-md-4 col-form-label text-md-end">Evento</label>
                            <div class="col-md-6">
                                    <select required class="form-select" id="event_id" name="event_id">
                                        {{ $events = Event::all() }}
                                        @if(empty($event))
                                            <option value="">Selecciona un evento</option>
                                        @endif
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            </div>
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus placeholder=" ejem. carne asada">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">Precio</label>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input id="price" type="number" class="form-control" name="price"
                                           value="{{ old('price') }}" required autocomplete="price" autofocus placeholder="100">
{{--                                        <span class="input-group-text">.00</span>--}}
                                    </div>
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
@endsection
