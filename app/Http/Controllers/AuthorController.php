<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    public function store(AuthorRequest $request)
    {
        $author = $this->authorService->createAuthor($request);
        return response()->json($author, 201);
    }
    public function index()
    {
        $authors = $this->authorService->getAuthors();
        return response()->json($authors, 200);
    }




}
