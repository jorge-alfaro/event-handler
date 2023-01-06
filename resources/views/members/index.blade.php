@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Member List</div>
                    <h3>Pending Member list</h3>
                    <div class="card-body">
                        <ol>
                            @forelse ($members as $member)
                                <li>{{ $member->name }}
                                    <form method="POST" action="{{ route('members.destroy'), $member->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </li>
                            @empty
                                <p>No users</p>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
