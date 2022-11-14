@extends('layouts.dashboard')

@section('content')
    <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10"
                class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input disabled type="file" name="image" id="image" class="form-control-file">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection
