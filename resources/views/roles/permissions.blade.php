@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('role.index') }}">&leftarrow; Back to list permissions</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <h2 class="mt-4">Permissions to {{ $role->name }}</h2>

                        <form action="{{ route('role.permissionsSync',$role->id,false) }}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')

                            @foreach($permissions as $permission)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ "{$permission->name}-{$permission->id}" }}" name="{{ $permission->id }}">
                                    <label class="custom-control-label" for="{{ "{$permission->name}-{$permission->id}" }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-block btn-success mt-4">Sync</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
