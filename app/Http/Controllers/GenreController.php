<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    // 1. READ ALL DATA
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

    // 2. CREATE DATA
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:50|unique:genres',
            'description' => 'required|string', // Pastikan divalidasi agar tidak error 500
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $genre = Genre::create([
            'name'        => $request->name,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Genre berhasil ditambahkan',
            'data'    => $genre
        ], 201);
    }

    // 3. SHOW DETAIL DATA (TUGAS PERTEMUAN 5)
    public function show($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data'    => $genre
        ], 200);
    }

    // 4. UPDATE DATA (TUGAS PERTEMUAN 5)
    public function update(Request $request, $id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:50|unique:genres,name,' . $id,
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 422);
        }

        $genre->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data'    => $genre
        ], 200);
    }

    // 5. DESTROY DATA (TUGAS PERTEMUAN 5)
    public function destroy($id)
    {
        $genre = Genre::find($id);

        if (!$genre) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        $genre->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully'
        ], 200);
    }
}