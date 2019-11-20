@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight"><h2>Usuarios</h2></div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('users.create')  }}" class="btn btn-primary" >Nuevo Usuario</a>
            </div>
            <div class="p-2 bd-highlight"></div>
        </div>
            <div class="row">
                <table class="table">

                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->index +1  }}</th>
                            <td>{{ $user->email  }}</td>
                            <td>{{ $user->getRol()->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
