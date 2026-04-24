<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
   public function index() {
    $genreModel = new Genre();
    $allGenres = $genreModel->getGenres();
    return view('genres', ['genres' => $allGenres]);
}
}