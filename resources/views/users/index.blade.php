@extends('layouts.app')
@section('content')
    <h3>Lista de usuarios</h3>
{{--    <a class="btn btn-success btn-sm mb-3" href="{{ route('products.create') }}"> Crear producto </a>--}}
    @empty($users))
    <div class="alert alert-warning">
        <h2>
        No existen usuarios registrados
        </h2>
    </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                <tr>
                    <th> Id</th>
                    <th> Nombre</th>
                    <th> email</th>
                    <th> Admin</th>

                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ optional($user->admin_since)->diffForHumans()??'No'}}</td>
                        <td><i class="fa fa-cogs"></i></td>


                        <td>
                            <form method="POST" class="d-inline"
                                  action="{{route('users.admin.toggle', ['user' => $user->id])}}">
                                @csrf
                                <button class="btn btn-danger" type="submit"> Cambio rol </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection
