<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
    $authors = \App\Models\Author::all();
    return response()->json([
        'success' => true,
        'message' => 'Daftar data penulis',
        'data'    => $authors
    ], 200);
    }
}
