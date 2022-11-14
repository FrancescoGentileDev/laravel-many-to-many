@extends('layouts.dashboard')

@section('content')
<h1>{{ $post->title }}</h1>
<img src="{{ $post->image }}" alt="">
<p>{{ $post->content }}</p>
@endsection
