@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="text-success" href="{{ route('role.create') }}">&plus; Add Role</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <table class="table table-striped mt-4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="d-flex">
                                        <a class="mr-3 btn btn-sm btn-outline-success" href="{{ route('role.edit',$role->id,false) }}">Edit</a>
                                        <a class="mr-3 btn btn-sm btn-outline-info" href="{{ route('role.show',$role->id,false) }}">Perfil</a>
                                        <form action="{{ route('role.destroy',$role->id,false) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-sm btn-outline-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
