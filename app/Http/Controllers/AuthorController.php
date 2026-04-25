<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
    // READ ALL DATA
    public function index() {
        $authors = Author::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar semua penulis',
            'data'    => $authors
        ], 200);
    }

    // CREATE DATA
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $image = $request->file('photo');
        $image->storeAs('public/authors', $image->hashName());

        $author = Author::create([
            'name'  => $request->name,
            'photo' => $image->hashName(),
        ]);

        return response()->json(['success' => true, 'message' => 'Penulis berhasil ditambah', 'data' => $author], 201);
    }
}
