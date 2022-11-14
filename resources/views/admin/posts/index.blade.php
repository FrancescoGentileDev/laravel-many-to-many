@extends('layouts.dashboard')


@section('content')
    <ul>

        @foreach ($posts as $post)
            <li>

                <a href="{{ route('admin.posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>

            </li>
        @endforeach

    </ul>
@endsection
