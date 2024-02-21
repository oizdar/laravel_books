<?php

namespace Tests\Feature\Api;

use App\Models\Book;
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

    public function testUserCanSeeClientDetails()
    {
        /** @var Client $client */
        $client = Client::factory()->create();

        $this->get(route('api.clients.show', $client->getKey()))
            ->assertOK()
            ->assertJson(fn($json) =>
                $json->has('data', fn($data) =>
                    $data->where('first_name', $client->first_name)
                        ->where('last_name', $client->last_name)
                        ->has('current_rentals')
                        ->where('created_at', $client->created_at->toDateTimeString())
                        ->where('updated_at', $client->updated_at->toDateTimeString())
                )
            );
    }


}
