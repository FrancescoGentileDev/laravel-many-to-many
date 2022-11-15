@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Categories</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ route('admin.categories.store') }}" method="POST" class="row">
                    @csrf
                    @method('POST')
                    <label for="category">Inserisci nome nuova categoria</label>
                    <input type="text" name="name" id="categoryInput"
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><a class="btn btn-primary"
                                        href="{{ route('admin.categories.show', ['category' => $category->slug]) }}">View</a>
                                </td>
                                <td>
                                    <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
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
