<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookService->createBook($request);
        return response()->json($book, 201);
    }
    public function index()
    {
        $books = $this->bookService->getBooks();
        return response()->json($books, 200);
    }
    public function searchByAuthor($surname)
    {
        $books = $this->bookService->searchBooksByAuthor($surname);
        if ($books) {
            return response()->json($books);
        }
        return response()->json(['message' => 'Author not found'], 404);
    }
    public function show($id)
    {
        $book = $this->bookService->getBook($id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }
    public function update(BookRequest $request, $id)
    {
        $book = $this->bookService->updateBook($request, $id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

}
