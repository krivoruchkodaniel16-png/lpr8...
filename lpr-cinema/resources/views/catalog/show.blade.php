@extends('layouts.app')

@section('content')
    <h1>{{ $movie['title'] }}</h1>
    <dl class="row">
        <dt class="col-sm-3">Код</dt>                <dd class="col-sm-9">{{ $movie['code'] }}</dd>
        <dt class="col-sm-3">Жанр</dt>               <dd class="col-sm-9">{{ $movie['genre'] }}</dd>
        <dt class="col-sm-3">Длительность</dt>       <dd class="col-sm-9">{{ $movie['duration_min'] }} мин</dd>
        <dt class="col-sm-3">Дата выхода</dt>        <dd class="col-sm-9">{{ \Illuminate\Support\Carbon::parse($movie['release_date'])->format('d.m.Y') }}</dd>
        <dt class="col-sm-3">Возрастной рейтинг</dt> <dd class="col-sm-9">{{ $movie['age_rating'] }}+</dd>
        <dt class="col-sm-3">3D</dt>                 <dd class="col-sm-9">{{ $movie['is_3d'] ? 'Да' : 'Нет' }}</dd>
    </dl>
    <a href="{{ route('catalog.index') }}">&larr; К каталогу</a>
@endsection
