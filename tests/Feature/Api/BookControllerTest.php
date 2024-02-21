<?php

namespace Tests\Feature\Api;

use App\Models\Book;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Book::factory()->count(30)->create();
    }

    public function testUserCanSeeBooksListPaginatedBy20()
    {
        $this->getJson(route('api.books.index'))
            ->assertOK()
            ->assertJsonCount(20, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'is_rented',
                        'rented_by',
                    ],
                ],
            ]);

        $this->getJson(route('api.books.index', ['page' => 2]))
            ->assertOK()
            ->assertJsonCount(10, 'data');
    }

    public function testUserCanSeeBookDetails()
    {
        $book = Book::factory()->create();

        $this->getJson(route('api.books.show', $book->getKey()))
            ->assertOK()
            ->assertJson(
                fn ($json) =>
                $json->has(
                    'data',
                    fn ($data) =>
                    $data->where('title', $book->title)
                    ->where('author', $book->author)
                    ->where('publisher', $book->publisher)
                    ->where('publication_year', $book->publication_year)
                    ->where('is_rented', false)
                    ->where('created_at', $book->created_at->toDateTimeString())
                    ->where('updated_at', $book->updated_at->toDateTimeString())
                    ->etc()
                )
            );
    }

}
