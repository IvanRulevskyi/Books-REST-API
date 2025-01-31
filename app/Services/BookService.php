<?php

namespace App\Services;


use App\Models\Author;
use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;


class BookService
{
    public function createBook($data)
    {
        $book = Book::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_date' => $data['publication_date']
        ]);
        if (isset($data['image_path'])) {
            $imageName = 'book_' . time() . '.' . $data['image_path']->getClientOriginalExtension();
            $data['image_path']->storeAs('public/images', $imageName);
            $book->image_path = asset('storage/images/' . $imageName);
            $book->save();
        }
        $book->authors()->attach($data['author_id']);

        return $book;
    }

    public function getBooks(): LengthAwarePaginator
    {
        return Book::query()->paginate(5);
    }

    public function searchBooksByAuthor(string $surname)
    {
        $author = Author::where('surname', $surname)->first();
        if ($author) {
            return $author->books()->paginate(2);

        }
        return null;
    }

    public function getBook(int $id)
    {
        $book = Book::where('id', $id)->first();
        if ($book) {
            return $book;
        }
        return null;
    }
    public function updateBook($data, int $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return null;
        }
        $book->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'publication_date' => $data['publication_date'],
        ]);

        if (isset($data['image_path'])) {
            if ($book->image_path) {
                Storage::delete(str_replace('storage/', 'public/', $book->image_path));
            }
            $imageName = 'book_' . time() . '.' . $data['image_path']->getClientOriginalExtension();
            $data['image_path']->storeAs('public/images', $imageName);
            $book->image_path = asset('storage/images/' . $imageName);
            $book->save();
        }
        if (isset($data['author_id'])) {
            $book->authors()->sync($data['author_id']);
        }
        return $book;
    }

}
