<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Resources\Book\BookCollection;
use App\Models\Book;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    #[OA\Get(
        path: '/books',
        description: 'Get a list of books',
        requestBody: new OA\RequestBody(ref: '#/components/schemas/BookIndexRequest'),
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    minimum: 1,
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BookCollection',
                ),
            ),
        ],
    )]
    public function index(BookIndexRequest $request): BookCollection
    {
        $books = Book::query()
            ->paginate(perPage: 20, page: $request->validated('page', 1));

        return new BookCollection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
