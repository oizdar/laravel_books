<?php

namespace App\Services;

use App\DTO\Client\ClientData;
use App\Models\Client;
use Throwable;

class ClientService
{

    public function store(ClientData $client): Client
    {
        /** @var Client $client */
        $client = Client::query()
            ->create($client->toArray());

        return $client;
    }

    /**
     * @throws Throwable
     */
    public function destroy(Client $client): void
    {
        $client->deleteOrFail();
    }

}
