<?php

namespace App\Http\Resources\Client;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientResource',
    description: 'ClientResource'
)]
class ClientResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'firstName', type: 'string')]
    #[OA\Property(property: 'lastName', type: 'string')]
    public function toArray($request): array
    {
        /** @var Client $client */
        $client = $this->resource;

        return [
            'id' => $client->getKey(),
            'firstName' => $client->first_name,
            'lastName' => $client->last_name,
        ];
    }
}
