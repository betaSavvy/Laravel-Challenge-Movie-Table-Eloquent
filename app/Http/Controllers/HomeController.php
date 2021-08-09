<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index()
    {
//        $movies = Movie::all()->sortByDesc(function($movie) {
//            return $movie->ratings->avg('rating');
//        })->take(100);

        $movies = Movie::select(['id', 'category_id', 'title', 'release_year'])
                       ->with('category:id,name')
                       ->withAvg('ratings', 'rating')
                       ->withCount('ratings')
                       ->limit(100)
                       ->get();

        return view('home', compact('movies'));
    }
}
