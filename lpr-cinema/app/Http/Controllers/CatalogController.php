<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных. ITEMS = 7
    private function movies(): array
    {
        return [
            ['id' => 1, 'code' => 'DR-01', 'title' => 'Брат', 'genre' => 'Драма',
                'duration_min' => 100, 'release_date' => '1997-05-17', 'age_rating' => 16, 'is_3d' => false],
            ['id' => 2, 'code' => 'CM-02', 'title' => 'Операция «Ы» и другие приключения Шурика', 'genre' => 'Комедия',
                'duration_min' => 95, 'release_date' => '1965-08-05', 'age_rating' => 6, 'is_3d' => false],
            ['id' => 3, 'code' => 'FN-03', 'title' => 'Аватар', 'genre' => 'Фантастика',
                'duration_min' => 162, 'release_date' => '2009-12-17', 'age_rating' => 12, 'is_3d' => true],
            ['id' => 4, 'code' => 'DR-04', 'title' => 'Движение вверх', 'genre' => 'Драма',
                'duration_min' => 133, 'release_date' => '2017-12-28', 'age_rating' => 6, 'is_3d' => false],
            ['id' => 5, 'code' => 'CM-05', 'title' => 'Ирония судьбы, или С лёгким паром!', 'genre' => 'Комедия',
                'duration_min' => 184, 'release_date' => '1976-01-01', 'age_rating' => 12, 'is_3d' => false],
            ['id' => 6, 'code' => 'FN-06', 'title' => 'Интерстеллар', 'genre' => 'Фантастика',
                'duration_min' => 169, 'release_date' => '2014-11-06', 'age_rating' => 12, 'is_3d' => false],
            ['id' => 7, 'code' => 'CM-07', 'title' => 'Джентльмены удачи', 'genre' => 'Комедия',
                'duration_min' => 84, 'release_date' => '1971-12-06', 'age_rating' => 6, 'is_3d' => false],
        ];
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $movies = collect($this->movies());

        $search = $request->query('q');
        if ($search) {
            $movies = $movies->filter(fn ($m) => mb_stripos($m['title'], $search) !== false);
        }

        $sort = $request->query('sort', 'title');
        if (in_array($sort, ['title', 'release_date', 'duration_min'])) {
            $movies = $movies->sortBy($sort);
        }

        return view('catalog.index', [
            'title' => 'Каталог фильмов',
            'movies' => $movies,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $movie = collect($this->movies())->firstWhere('id', $id);
        abort_if(! $movie, 404);

        return view('catalog.show', ['title' => $movie['title'], 'movie' => $movie]);
    }

    // GET /catalog/code/DR-01
    public function byCode(string $code)
    {
        $movie = collect($this->movies())->firstWhere('code', $code);
        abort_if(! $movie, 404);

        return view('catalog.show', ['title' => $movie['title'], 'movie' => $movie]);
    }

    // GET /catalog/genre/Драма или /catalog/genre (⭐ список жанров)
    public function byGenre(?string $genre = null)
    {
        $movies = collect($this->movies());

        if (! $genre) {
            return view('catalog.genres', [
                'title' => 'Все жанры',
                'genres' => $movies->pluck('genre')->unique()->values(),
            ]);
        }

        return view('catalog.index', [
            'title' => "Фильмы жанра: {$genre}",
            'movies' => $movies->where('genre', $genre),
            'search' => null,
            'sort' => 'title',
        ]);
    }

    // ⭐ GET /catalog/stats
    public function stats()
    {
        $movies = collect($this->movies());

        return view('catalog.stats', [
            'title' => 'Статистика',
            'count' => $movies->count(),
            'avg' => $movies->avg('duration_min'),
            'min' => $movies->min('duration_min'),
            'max' => $movies->max('duration_min'),
        ]);
    }
}
