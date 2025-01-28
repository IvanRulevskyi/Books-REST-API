<?php

namespace App\Services;

use App\Http\Requests\BookRequest;
use App\Models\Author;
use App\Models\Book;

class BookService
{
    public function createBook(BookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
        ]);
        $book->authors()->attach($request->author_id);;
        return $book;
    }

    public function getBooks()
    {
        return Book::all();
    }

    public function searchBooksByAuthor($surname)
    {
        $author = Author::where('surname', $surname)->first();
        if ($author) {
            return $author->books;
        }
        return false;
    }

    public function getBook($id)
    {
        $book = Book::where('id', $id)->first();
        if ($book) {
            return $book;
        }
        return false;
    }
    public function updateBook($request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return false;
        }
        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'publication_date' => $request->publication_date,
        ]);
        $book->authors()->sync($request->author_id);
        return $book;
    }
}
