<?php

namespace App\Http\Controllers;

use App\DTO\Book\BookSearchData;
use App\Http\Requests\Book\BookIndexRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookDetailsResource;
use App\Models\Book;
use App\Services\BookService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    #[OA\Get(
        path: '/books',
        description: 'Get a list of books',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/page'),
            new OA\Parameter(ref: '#/components/parameters/per_page'),
            new OA\Parameter(
                name: 'title',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string'),
            ),
            new OA\Parameter(
                name: 'author',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string'),
            ),
            new OA\Parameter(
                name: 'client_first_name',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string'),
            ),
            new OA\Parameter(
                name: 'client_last_name',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string'),
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
    public function index(BookIndexRequest $request, BookService $bookService): BookCollection
    {
        $query = $bookService->queryBySearchData(BookSearchData::fromBookIndexRequest($request));
        $books = $query->with('currentRental.client')
            ->paginate(
                perPage:  $request->validated('per_page', 20),
                page: $request->validated('page', 1)
            );

        return BookCollection::make($books);
    }

    #[OA\Get(
        path: '/books/{book}',
        description: 'Get book details',
        tags: ['Books'],
        parameters: [
            new OA\Parameter(
                name: 'book',
                description: 'Book ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BookDetailsResource',
                ),
            ),
        ],
    )]
    public function show(Book $book): BookDetailsResource
    {
        $book->load('currentRental.client');

        return new BookDetailsResource($book);
    }
}
