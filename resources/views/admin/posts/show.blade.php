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
                                <h6>
                                    <span class="badge badge-primary">{{ $post->category->name }}</span>
                                </h6>
                                <h5 class="card-title">
                                    {{ $post->title }}
                                </h5>
                                <p class="card-text">{{ $post->content }}</p>
                                <p class="card-text"><small class="text-muted">Post uploaded: {{ $post->updated_at }}</small></p>
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
