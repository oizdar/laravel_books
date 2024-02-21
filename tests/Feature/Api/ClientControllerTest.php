<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Client::factory()->count(20)->create();
    }

    public function testUserCanSeeBooksListPaginatedBy20()
    {
        $this->get(route('api.clients.index'))
            ->assertOK()
            ->assertJsonCount(15, 'data');

        $this->get(route('api.clients.index', ['page' => 2]))
            ->assertOK()
            ->assertJsonCount(5, 'data');
    }


}
