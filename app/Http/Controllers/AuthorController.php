<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // WAJIB ada untuk hapus foto

class AuthorController extends Controller
{
    // 1. READ ALL DATA
    public function index() {
        $authors = Author::all();
        return response()->json([
            'success' => true,
            'message' => 'Daftar semua penulis',
            'data'    => $authors
        ], 200);
    }

    // 2. CREATE DATA
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'photo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'message' => $validator->errors()
            ], 422);
        }

        $image = $request->file('photo');
        $image->storeAs('public/authors', $image->hashName());

        $author = Author::create([
            'name'  => $request->name,
            'photo' => $image->hashName(),
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Penulis berhasil ditambah', 
            'data'    => $author
        ], 201);
    }

    // SHOW DETAIL DATA 
    public function show($id) {
        $author = Author::find($id);

        if (!$author) {
            return response()->json([
                'success' => false,
                'message' => 'Resource not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Get detail resource',
            'data'    => $author
        ], 200);
    }

    // UPDATE DATA 
    public function update(Request $request, $id) {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()], 422);
        }

        $data = ['name' => $request->name];

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $image->storeAs('public/authors', $image->hashName());

            // Hapus foto lama
            Storage::delete('public/authors/' . $author->photo);

            $data['photo'] = $image->hashName();
        }

        $author->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
            'data'    => $author
        ], 200);
    }

    // DESTROY DATA 
    public function destroy($id) {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        // Hapus file foto dari storage
        Storage::delete('public/authors/' . $author->photo);

        $author->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully'
        ], 200);
    }
}