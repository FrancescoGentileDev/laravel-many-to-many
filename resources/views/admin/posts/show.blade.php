@extends('layouts.dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $post->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row no-gutters">
                        @if($post->image)
                        <div class="col-md-4">

                            <img src="{{ $post->image }}" class="card-img" alt="...">

                        </div>
                         @endif
                        <div class="col-md-8">
                            <div class="card-body">
                                @if($post->category)
                                <h6>
                                    <a href="{{ route('admin.categories.show', $post->category->slug)}}" class="badge badge-primary">{{ $post->category->name }}</a>
                                </h6>
                                @endif
                                <h5 class="card-title">
                                    {{ $post->title }}
                                </h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <p class="card-text"><small class="text-muted">Post uploaded: {{ $post->updated_at }}</small></p>

                                    @forelse ($post->tags as $tag)
                                        <a href="{{ route('admin.tags.show', $tag->slug) }}" class="badge badge-danger">{{ $tag->name }}</a>
                                    @empty
                                        <span class="badge badge-primary">No tags</span>
                                    @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-primary" href="{{ route('admin.posts.index') }}">Torna alla lista</a>
            </div>
        </div>
    </div>

@endsection
