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
    #[OA\Property(property: 'firstName', type: 'string')]
    #[OA\Property(property: 'lastName', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Client $client */
        $client = $this->resource;

        return [
            'firstName' => $client->first_name,
            'lastName' => $client->last_name,
        ];
    }
}
