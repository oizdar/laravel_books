<?php

namespace Tests\Feature\Api;

use App\Models\Book;
use App\Models\Client;
use App\Models\Rental;
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

    public function testFilteredList()
    {
        $book1 = Book::factory()->create([
            'title' => 'Testowy tytuł 1',
            'author' => 'Testowy autor 1',
        ]);

        $book2 = Book::factory()->create([
            'title' => 'Testowy tytuł 2',
            'author' => 'Testowy autor 1',
        ]);

        $book3 = Book::factory()->create([
            'title' => 'Testowy tytuł 3',
            'author' => 'Testowy autor 2',
        ]);

        $client1 = Client::factory()->create([
            'first_name' => 'TestoweImię1',
            'last_name' => 'TestoweNazwisko',
        ]);

        $client2 = Client::factory()->create([
            'first_name' => 'TestoweImię2',
            'last_name' => 'TestoweNazwisko',
        ]);

        Rental::factory()->create([
            'client_id' => $client1->getKey(),
            'book_id' => $book1->getKey(),
        ]);

        Rental::factory()->create([
            'client_id' => $client2->getKey(),
            'book_id' => $book2->getKey(),
        ]);


        $this->getJson(route('api.books.index', ['title' => 'Testowy tytuł 1']))
            ->assertOK()
            ->assertJsonCount(1, 'data');

        $this->getJson(route('api.books.index', ['title' => 'Testowy tytuł 2']))
            ->assertOK()
            ->assertJsonCount(1, 'data');

        $this->getJson(route('api.books.index', ['title' => 'Testowy']))
            ->assertOK()
            ->assertJsonCount(3, 'data');

        $this->getJson(route('api.books.index', ['author' => 'Testowy autor 1']))
            ->assertOK()
            ->assertJsonCount(2, 'data');

        $this->getJson(route('api.books.index', ['client_first_name' => 'TestoweImię1']))
            ->assertOK()
            ->assertJsonCount(1, 'data');

        $this->getJson(route('api.books.index', ['client_first_name' => 'TestoweImię2']))
            ->assertOK()
            ->assertJsonCount(1, 'data');

        $this->getJson(route('api.books.index', ['client_last_name' => 'TestoweNazwisko']))
            ->assertOK()
            ->assertJsonCount(2, 'data');
    }

}
