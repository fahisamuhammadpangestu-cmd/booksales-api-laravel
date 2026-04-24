<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = \App\Models\Book::all();
        return response()->json([
        'success' => true,
        'message' => 'Daftar data buku',
        'data'    => $books
    ], 200);                          
    }
}