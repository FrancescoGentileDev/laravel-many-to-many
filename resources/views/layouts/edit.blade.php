@extends('layouts.dashboard')

@section('content')
    <h1>{{ $data['title'] }}</h1>
    <form action="{{ $data['form']['route'] }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method($data['form']['method'])

        @foreach ($data['form']['fields'] as $form)
            <div class="form-group">
                <label for="{{ $form['label'] }}">{{ $form['label'] }}</label>
                <input type="{{ $form['type'] }}" name="{{ $form['label'] }}" id="{{ $form['label'] }}" class="form-control @error( $form['label'] ) is-invalid @enderror"
                value="{{ old( $form['label'], $form['value'] ) }}">

                @error( $form['label'] )
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        @endforeach


        <input type="submit" value="Save" class="btn btn-primary">
    </form>
@endsection
