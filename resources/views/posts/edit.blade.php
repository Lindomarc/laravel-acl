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

                        <form action="{{ route('post.update', ['post' => $post->id]) }}" method="post" class="mt-4"
                              autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" id="title"
                                       placeholder="Enter the title of the article"
                                       name="title" value="{{ old('title') ?? $post->title }}">
                            </div>

                            <div class="form-group">
                                <label for="content">Text</label>
                                <textarea class="form-control" id="text" rows="3" name="text"
                                          placeholder="Insert content ...">{{ old('text') ?? $post->text }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="content">Published</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published" id="published-true"
                                           value="1" {{ $post->published == true ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published-true">
                                        yes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published"
                                           id="published-false"
                                           value="0" {{ $post->published == false ? 'checked' : '' }}>
                                    <label class="form-check-label" for="published-false">
                                        No
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-block btn-success">Edit</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
