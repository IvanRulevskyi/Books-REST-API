<?php

namespace App\Services;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;

class AuthorService
{
    public function createAuthor(AuthorRequest $request)
    {
        return Author::create($request->all());
    }
    public function getAuthors()
    {
        return Author::all();
    }
}
