@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Evento</a>
                    @if($event)
                        <a href="#" class="list-group-item list-group-item-action">{{ $event->name }}</a>
                    @else
                        <a href="#" class="list-group-item list-group-item-action"> No hay eventos activos</a>
                    @endif

                    {{--                    <a href="#" class="list-group-item list-group-item-action disabled">Morbi leo risus</a>--}}
                </div>
            </div>

        </div>
        <div class="row mt-2">
            <div class="col">
                <div class="card">
                    <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active bg-success">Cuenta</a>

                        @foreach($products as $p)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$p->name}}
                                <span class="badge bg-success rounded-pill"> $ {{ $p->price }}</span>
                            </li>
                        @endforeach
                        {{--                       TOTAL--}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <button type="button" class="btn btn-outline-success">$ {{ $total }}</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-2">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Total por miembro</a>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        c/u
                        <button type="button" class="btn btn-outline-success">$ {{ $theCheck }}</button>
                    </li>
                </div>
            </div>

            <div class="card mt-2">
                <ul class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">Miembros</a>
                    @if(!$members)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            No hay miembros registrados
                            <span class="badge bg-success rounded-pill"> $ 0</span>
                        </li>
                    @endif
                    @foreach($members as $m)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$m->name}}
                                @if($m->payment_status['pagado'])
                                <span class="badge bg-success rounded-pill"> Pagado</span>
                            @else
                                <span class="badge bg-success rounded-pill"> Pendiente</span>
                                @endif

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
