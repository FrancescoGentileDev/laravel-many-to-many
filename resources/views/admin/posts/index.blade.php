@extends('layouts.dashboard')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Posts</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create new post</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td><a class="btn btn-primary" href="{{ route('admin.posts.show', ['post' => $post->slug]) }}">View</a></td>
                                <td><a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a></td>
                                <td>
                                    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    <ul>
@endsection
