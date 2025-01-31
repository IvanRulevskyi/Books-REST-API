<?php

namespace App\Services;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;

class AuthorService
{
    public function createAuthor(array $data): Author
    {
        return Author::create($data);
    }

    public function getAuthors()
    {
        return Author::paginate(3);
    }
}
