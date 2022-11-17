@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>@yield('title')</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="{{ $data['create']['route'] }}" method="POST" class="row">
                    @csrf
                    <label for="category">{{ $data['create']['label'] }}</label>
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
                            @foreach ($data['table']['head'] as $item)
                                <th colspan="1">{{ $item }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['elem'] as $el)
                            <tr>
                                <td>{{ $el->name }}</td>
                                <td><a class="btn btn-primary"
                                        href="{{ route($data['table']['body']['actions']['show']['route'], $el->slug) }}">View</a>
                                </td>
                                <td>
                                    <form action="{{ route($data['table']['body']['actions']['delete']['route'], $el->id) }}"
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
