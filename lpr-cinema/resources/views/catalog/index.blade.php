@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form method="GET" action="{{ route('catalog.index') }}" class="row g-2 mb-3">
        <div class="col-auto">
            <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Название...">
        </div>
        <div class="col-auto">
            <select name="sort" class="form-select">
                <option value="title" @selected($sort === 'title')>По названию</option>
                <option value="release_date" @selected($sort === 'release_date')>По дате выхода</option>
                <option value="duration_min" @selected($sort === 'duration_min')>По длительности</option>
            </select>
        </div>
        <div class="col-auto"><button class="btn btn-secondary">Найти</button></div>
    </form>

    <table class="table">
        <tr><th>№</th><th>Название</th><th>Жанр</th><th>Длительность</th><th>Возраст</th><th></th></tr>
        @forelse ($movies as $movie)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><a href="{{ route('catalog.show', ['id' => $movie['id']]) }}">{{ $movie['title'] }}</a></td>
                <td><a href="{{ route('catalog.genre', $movie['genre']) }}">{{ $movie['genre'] }}</a></td>
                <td>{{ $movie['duration_min'] }} мин</td>
                <td>{{ $movie['age_rating'] }}+</td>
                <td>@if ($movie['is_3d']) <span class="badge bg-primary">3D</span> @endif</td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-muted">Ничего не найдено.</td></tr>
        @endforelse
    </table>
@endsection
