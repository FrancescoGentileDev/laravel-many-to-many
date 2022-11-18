@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{ $data['title'] }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (!empty($data['create']))
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
                @endif

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
                        @forelse ($data['elem'] as $el)
                            <tr>
                                <?php
                                if(!empty($el[$data['table']['body']['name']]->name) )
                                {
                                    $name = $el[$data['table']['body']['name']]->name;
                                }
                                else
                                {
                                    $name = $el[$data['table']['body']['name']];
                                }
                                ?>
                                <td>{{ $name }}</td>
                                <td><a class="btn btn-primary"
                                        href="{{ route($data['table']['body']['actions']['show']['route'], $el->slug) }}">View</a>
                                </td>
                                <td><a class="btn btn-warning"
                                        href="{{ route($data['table']['body']['actions']['edit']['route'], $el->id) }}">Edit</a>
                                <td>
                                    <form
                                        action="{{ route($data['table']['body']['actions']['delete']['route'], $el->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center mt-5"><h1>😢 No posts for this {{ $data['title'] }} 😢</h1></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <ul>
    </div>
@endsection
