<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Carbon\Carbon;
use Database\Seeders\ClientSeeder;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    protected bool $seed = true;
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(ClientSeeder::class);
    }

    public function testUserCanSeeBooksListPaginatedBy20()
    {
        $count = Client::query()->count();

        $this->getJson(route('api.clients.index'))
            ->assertOK()
            ->assertJsonCount(15, 'data');

        $this->getJson(route('api.clients.index', ['page' => 2]))
            ->assertOK()
            ->assertJsonCount($count - 15, 'data');
    }

    public function testUserCanSeeClientDetails()
    {
        /** @var Client $client */
        $client = Client::factory()->create();

        $this->getJson(route('api.clients.show', $client->getKey()))
            ->assertOK()
            ->assertJson(
                fn ($json) =>
                $json->has(
                    'data',
                    fn ($data) =>
                    $data->where('id', $client->getKey())
                        ->where('first_name', $client->first_name)
                        ->where('last_name', $client->last_name)
                        ->has('current_rentals')
                        ->where('created_at', $client->created_at->toDateTimeString())
                        ->where('updated_at', $client->updated_at->toDateTimeString())
                )
            );
    }

    public function testUserCanCreateClient()
    {
        /** @var Client $client */
        $client = Client::factory()->make();

        $this->postJson(
            route('api.clients.store'),
            [
            'first_name' => $client->first_name,
            'last_name' => $client->last_name]
        )
            ->assertCreated()
            ->assertJson(
                fn ($json) =>
                $json->has(
                    'data',
                    fn ($data) =>
                    $data->where('first_name', $client->first_name)
                        ->where('last_name', $client->last_name)
                        ->etc()
                )
            );

        $this->assertDatabaseHas('clients', [
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
        ]);
    }

    public function testUserCanDeleteClient()
    {
        /** @var Client $client */
        $client = Client::factory()->create();

        Carbon::setTestNow(now());
        $this->deleteJson(route('api.clients.destroy', $client->getKey()))
            ->assertNoContent();

        $this->assertDatabaseHas('clients', [
            'id' => $client->getKey(),
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'deleted_at' => now(),
        ]);
    }



}
