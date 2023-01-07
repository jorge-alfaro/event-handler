@extends('layouts.app')

@section('content')

    <div class="container-sm">
        <div class="col-md-6 offset-md-3">
            <div class="row mt-2">
                <div class="col">
                    <div class="list-group text-center">
                        <a href="#" class="list-group-item list-group-item-action active">Evento</a>
                        @if($event)
                            <a href="#" class="list-group-item list-group-item-action text-warning">{{ $event->name }}</a>
                        @else
                            <a href="#" class="list-group-item list-group-item-action text-danger"> No hay eventos activos</a>
                        @endif

                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col">
                    <div class="card">
                        <ul class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active bg-success">Cuenta</a>
                            @forelse ($products as $p)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{$p->name}}
                                    <span class="badge bg-success rounded-pill"> $ {{ $p->price }}</span>
                                </li>
                            @empty
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                  No hay productos registrados
                                    <span class="badge bg-success rounded-pill"> <i class="fa-solid fa-ghost"></i></span>
                                </li>
                            @endforelse
                            <!-- TOTAL -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total
                                <button type="button" class="btn btn-outline-success">$ {{ $total }}</button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-2">
                    <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Total por miembro</a>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <i class="fa-solid fa-user"></i>
                            <button type="button" class="btn btn-outline-success">$ {{ $theCheck }}</button>
                        </li>
                    </ul>
                </div>

                <div class="card mt-2">
                    <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active">Miembros</a>
                        @forelse ($members as $m)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$m->name}}
                                @if($m->payment_status['paid'])
                                    <span class="badge bg-success rounded-pill"> Pagado</span>
                                @elseif($m->payment_status['a_piece'])
                                    <span class="badge bg-success rounded-pill"> Abonado</span>
                                @else
                                    <span class="badge bg-success rounded-pill"> Pendiente</span>
                                @endif

                            </li>
                        @empty
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <i class="fa-solid fa-user-slash"></i> No hay miembros registrados.
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
