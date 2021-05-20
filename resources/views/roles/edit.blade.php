@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('role.index') }}">&leftarrow; Back to List Roles</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('role.update', $role->id, false) }}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Role Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter the role name"
                                       name="name" value="{{ old('name')??$role->name }}">
                            </div>
                            <button type="submit" class="btn btn-block btn-success">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
