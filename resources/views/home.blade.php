@php use App\Models\Member; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div
                        class="card-header"> {{ $greetings }}  {{ $string = Str::of(Auth::user()->name)->ucfirst() }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>
                    <div>
                        <div class="list-group">
                            <a href="{{ route('main') }}"
                               class="list-group-item list-group-item-action flex-column align-items-start active">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Evento activo</h5>
                                    <small>{{ $timeAgo }}</small>
                                </div>
                                <p class="mb-1 text-warning">{{ $eventName }}</p>
                                <small><i class="fa-solid fa-champagne-glasses"></i> {{ $countMembers }} miembros en
                                    este evento</small>
                            </a>

                        </div>
                    </div>
                </div>
                <p class="text-info">La cuenta hasta ahora: $ {{ $totalCheckEvent }}</p>
            </div>

            <!-- TABS-->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#paid" aria-selected="true" role="tab">Pendientes</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#piece" aria-selected="false" role="tab"
                       tabindex="-1">Pagado</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link disabled" href="#" aria-selected="false" tabindex="-1" role="tab">soon..</a>
                </li>
            </ul>

            <div id="myTabContent" class="tab-content">
                <!-- Primera Tab-->
                <div class="tab-pane fade active show" id="paid" role="tabpanel">
                    <ul class="list-group mt-3">
                        @foreach(Member::query()->where('event_id',$activeEventId)->get() as $m)
                            <form method="POST" action="{{ route('members.update') }}">
                                @csrf
                                @method('PUT')
                                @if(!$m->payment_status['paid'])
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <input type="hidden" name="edit_id" id="edit_id" value="{{ $m->id }}">
                                    {{ $m->name }}
                                    <fieldset class="form-group">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch me-2">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckDefault" name="paid"
                                                       @if($m->payment_status['paid']) checked @endif>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckDefault">Pagado</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked" name="a_piece"
                                                       @if($m->payment_status['a_piece']) checked @endif>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked">Abonado</label>
                                            </div>
                                            <div class="col-md-6 offset-md-4 ms-2">
                                                <button type="submit" class="btn btn-outline-light">
                                                    Cambiar
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </li>
                                @endif
                            </form>
                        @endforeach
                    </ul>

                </div>
                <!-- Segunda Tab Pagado-->
                <div class="tab-pane fade" id="piece" role="tabpanel">
                    <ul class="list-group mt-3">
                        @foreach(Member::query()->where('event_id',$activeEventId)->get() as $m)
                            <form method="POST" action="{{ route('members.update') }}">
                                @csrf
                                @method('PUT')
                                @if($m->payment_status['paid'])
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <input type="hidden" name="edit_id" id="edit_id" value="{{ $m->id }}">
                                    {{ $m->name }}
                                    <fieldset class="form-group">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch me-2">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckDefault" name="paid"
                                                       @if($m->payment_status['paid']) checked @endif>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckDefault">Pagado</label>
                                            </div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                       id="flexSwitchCheckChecked" name="a_piece"
                                                       @if($m->payment_status['a_piece']) checked @endif>
                                                <label class="form-check-label"
                                                       for="flexSwitchCheckChecked">Abonado</label>
                                            </div>
                                            <div class="col-md-6 offset-md-4 ms-2">
                                                <button type="submit" class="btn btn-outline-light">
                                                    Cambiar
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </li>
                                @endif
                            </form>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- END TABS-->


        </div>
    </div>
@endsection
