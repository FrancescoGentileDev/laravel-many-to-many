@extends('layouts.dashboard')


@section('content')
    <ul>

        @foreach ($posts as $post)
            <li class="mt-3">

                <a href="{{ route('admin.posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                <a class="btn btn-primary" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Edit</a>

                <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-primary" type="submit" value="Delete">
                </form>

            </li>
        @endforeach

    </ul>
@endsection
