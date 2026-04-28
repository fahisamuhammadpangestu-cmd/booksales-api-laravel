<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // 1. READ ALL DATA
    public function index()
    {
        $books = Book::with(['author', 'genre'])->get(); 

        $books = Book::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar data buku',
            'data'    => $books
        ], 200);                                   
    }

    // 2. CREATE DATA
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

        // Upload Image
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
        ], 201);
    }

    // SHOW DATA
    public function show($id)
    {
        $book = Book::with(['author', 'genre'])->find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data'    => $book
        ], 200);
    } 
    public function destroy($id)
{
    $book = Book::find($id);

    if (!$book) {
        return response()->json([
            'success' => false,
            'message' => 'Resource not found'
        ], 404);
    }

    Storage::delete('public/books/' . $book->cover);

    $book->delete();

    return response()->json([
        'success' => true,
        'message' => 'Delete resource successfully'
    ], 200);
}

public function update(Request $request, $id)
{
    $book = Book::find($id);
    if (!$book) {
        return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
    }

    $validator = Validator::make($request->all(), [
        'title'       => 'required|string|max:100',
        'description' => 'required|string',
        'price'       => 'required|numeric',
        'stock'       => 'required|integer',
        'cover'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'genre_id'    => 'required|exists:genres,id',
        'author_id'   => 'required|exists:authors,id',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()], 422);
    }

    $data = [
        'title'       => $request->title,
        'description' => $request->description,
        'price'       => $request->price,
        'stock'       => $request->stock,
        'genre_id'    => $request->genre_id,
        'author_id'   => $request->author_id,
    ];

    if ($request->hasFile('cover')) {
        // Upload gambar baru
        $image = $request->file('cover');
        $image->storeAs('public/books', $image->hashName());

        // Hapus gambar lama dari storage
        Storage::delete('public/books/' . $book->cover);

        // Masukkan nama file baru ke array data
        $data['cover'] = $image->hashName();
    }

    // 5. Eksekusi Update ke Database
    $book->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Resource updated successfully',
        'data'    => $book
    ], 200);
}
}