<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorService $authorService)
    {
    }

    //create author
    public function store(AuthorRequest $request): JsonResponse
    {
        $data = $request->all();
        return response()->json($this->authorService->createAuthor($data), Response::HTTP_CREATED);
    }

    //get all authors
    public function index(): JsonResponse
    {
        return response()->json($this->authorService->getAuthors(), Response::HTTP_OK);
    }
}
