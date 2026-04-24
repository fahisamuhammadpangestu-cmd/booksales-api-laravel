<?php

namespace App\Http\Controllers;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index() {
        $authorModel = new Author();
        $allAuthors = $authorModel->getAuthors();
        return view('authors', ['authors' => $allAuthors]);
    }
}
