@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        @foreach ($genres as $genre)
            <li><a href="{{ route('catalog.genre', $genre) }}">{{ $genre }}</a></li>
        @endforeach
    </ul>
@endsection
