<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
   public function index() {
        $bookModel = new Book();
        $allBooks = $bookModel->getBooks();
        return view('books', ['books' => $allBooks]);
    }
}
