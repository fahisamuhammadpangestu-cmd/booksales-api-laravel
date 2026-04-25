<?php

namespace App\Http\Controllers;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
   public function index()
{
    $genres = Genre::all();

    if ($genres->isEmpty()) {
        return response()->json([
            'success' => true,
            'message' => 'Data genre kosong',
        ], 200);
    }

    return response()->json([
        'success' => true,
        'message' => 'Daftar semua genre',
        'data'    => $genres
    ], 200);
}
public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:50|unique:genres', 
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()
        ], 422);
    }

    $genre = Genre::create([
    'name' => $request->name,
    'description' => $request->description 
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Genre berhasil ditambahkan',
        'data'    => $genre
    ], 201);
}
}
