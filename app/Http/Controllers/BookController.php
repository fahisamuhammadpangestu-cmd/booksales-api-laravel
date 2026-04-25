<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function show($id) {
    $book = Book::find($id);

    if (!$book) {
        return response()->json([
            'success' => false,
            'message' => 'Buku tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'message' => 'Detail data buku',
        'data'    => $book
    ], 200);
}
public function store(Request $request)
{

    $validator = Validator::make($request->all(), [
        'title'       => 'required|string|max:100',
        'description' => 'required|string',
        'price'       => 'required|numeric',
        'stock'       => 'required|integer',
        'cover'       => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'genre_id'    => 'required|exists:genres,id',
        'author_id'   => 'required|exists:authors,id',
    ]);


    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors(),
        ], 422);
    }

    $image = $request->file('cover');
    $image->storeAs('public/books', $image->hashName());

    $book = Book::create([
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'stock'       => $request->stock,
        'cover'       => $image->hashName(),
        'genre_id'    => $request->genre_id,
        'author_id'   => $request->author_id,
    ]);

 
    return response()->json([
        'success' => true,
        'message' => 'Resource added successfully',
        'data'    => $book
    ], 201); // Status 201 artinya Created
}
}