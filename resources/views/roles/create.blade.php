@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('role.index') }}">&leftarrow; Back to List</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('role.store', null, false) }}" method="post" class="mt-4" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter the name"
                                       name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="guard_name">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter the guard name"
                                       name="guard_name" value="{{ old('guard_name') }}">
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
