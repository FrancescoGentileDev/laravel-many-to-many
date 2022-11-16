@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Tags</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.tags.store') }}" method="POST" class="row">
                    @csrf
                    @method('POST')
                    <label for="category">Inserisci nome nuovo tag</label>
                    <input type="text" name="name" id="tagsInput"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <input type="submit" class="btn btn-primary my-3" value="Salva">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th colspan="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->name }}</td>
                                <td><a class="btn btn-primary"
                                        href="{{ route('admin.tags.show', ['tag' => $tag->slug]) }}">View</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}"
                                        method="POST">
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
    </div>
@endsection
