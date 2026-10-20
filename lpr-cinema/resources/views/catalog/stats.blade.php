@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <ul>
        <li>Количество фильмов: {{ $count }}</li>
        <li>Средняя длительность: {{ number_format($avg, 1, ',', ' ') }} мин</li>
        <li>Минимальная: {{ $min }} мин</li>
        <li>Максимальная: {{ $max }} мин</li>
    </ul>
    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
