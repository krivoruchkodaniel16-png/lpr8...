@extends('layouts.app')

@section('content')
    <h1>404 — страница не найдена</h1>
    <p class="text-muted">Запрошенный путь: <code>/{{ request()->path() }}</code></p>
    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
