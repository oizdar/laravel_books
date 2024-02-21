<?php

namespace Tests\Feature\Api;

use App\Models\Book;
use App\Models\Client;
use App\Models\Rental;
use Carbon\Carbon;
use Tests\TestCase;

class RentalControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testUserCanCreateRental()
    {

        $client = Client::factory()->create();
        $book = Book::factory()->create();

        $this->postJson(route('api.rentals.store'), [
            'client_id' => $client->getKey(),
            'book_id' => $book->getKey(),
        ])
            ->assertCreated()
            ->assertJson(
                fn ($json) =>
                $json->has(
                    'data',
                    fn ($data) =>
                    $data->has('client')
                        ->has('book')
                        ->etc()
                )
            );

        $this->assertDatabaseHas('rentals', [
            'client_id' => $client->getKey(),
            'book_id' => $book->getKey(),
            'returned_at' => null,
        ]);
    }

    public function testUserCannotCreateRentalForAlreadyRentedBooks()
    {
        $client = Client::factory()->create();
        $book = Book::factory()->create();
        Rental::factory()
            ->forBook($book)
            ->create();

        $this->postJson(route('api.rentals.store'), [
            'client_id' => $client->getKey(),
            'book_id' => $book->getKey(),
        ])
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('book_id');

    }


    public function testUserCanReturnRentedBook()
    {
        Carbon::setTestNow(now());

        $rental = Rental::factory()
            ->create();

        $this->patchJson(route('api.rentals.return', $rental->getKey()))
            ->assertOk()
            ->assertJson(
                fn ($json) =>
                    $json->has(
                        'data',
                        fn ($data) =>
                            $data->has('client')
                                ->has('book')
                                ->where('returned_at', now()->toDateTimeString())
                                ->etc()
                    )
            );

        $this->patchJson(route('api.rentals.return', $rental->getKey()))
            ->assertUnprocessable()
            ->assertJsonValidationErrorFor('rental');
    }
}
