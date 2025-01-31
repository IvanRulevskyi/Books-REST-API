<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function __construct(private readonly BookService $bookService)
    {
    }

    //create book
    public function store(BookRequest $request): JsonResponse
    {
        $data = $request->all();
        return response()->json($this->bookService->createBook($data), Response::HTTP_CREATED);
    }

    //get all book
    public function index(): JsonResponse
    {
        return response()->json($this->bookService->getBooks(), Response::HTTP_OK);
    }

    //search book by author patronymic
    public function searchByAuthor(string $surname): JsonResponse
    {
        $books = $this->bookService->searchBooksByAuthor($surname);
        if ($books) {
            return response()->json($books);
        }
        return response()->json(['message' => 'Author not found'], Response::HTTP_NOT_FOUND);
    }

    //get one book
    public function show(int $id): JsonResponse
    {
        $book = $this->bookService->getBook($id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], Response::HTTP_NOT_FOUND);
    }

    //update book
    public function update(BookRequest $request, int $id): JsonResponse
    {
        $data = $request->all();
        $book = $this->bookService->updateBook($data, $id);
        if ($book) {
            return response()->json($book);
        }
        return response()->json(['message' => 'Book not found'], Response::HTTP_NOT_FOUND);
    }
}
