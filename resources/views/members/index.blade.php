@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       Miembros
                    </div>
                    @forelse ($members as $member)
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item text-bg-info">
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

                </div>
            </div>
        </div>
    </div>
@endsection
