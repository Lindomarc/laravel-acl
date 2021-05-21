@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">

                        <a class="text-success" href="{{ route('post.index') }}">&leftarrow; Back to list</a>

                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <form action="{{ route('post.store') }}" method="post" class="mt-4" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title"
                                       placeholder="Enter the title of the article"
                                       name="title" value="{{ old('title') }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Text</label>
                                <textarea class="form-control" id="text" rows="3" name="text"
                                          placeholder="Enter the content"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Published</label>
                                <div class="form-check">
                                    <input id="published-true"  class="form-check-input" type="radio" name="published" value="1" checked>
                                    <label class="form-check-label" for="published-true">
                                        Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input id="published-false" class="form-check-input" type="radio" name="published" value="0">
                                    <label class="form-check-label" for="published-false">
                                        No
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Save</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
