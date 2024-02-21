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
        $this->get(route('api.books.index'))
            ->assertOK()
            ->assertJsonCount(20, 'data');

        $this->get(route('api.books.index', ['page' => 2]))
            ->assertOK()
            ->assertJsonCount(10, 'data');
    }


}
