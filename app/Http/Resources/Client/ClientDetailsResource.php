<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Book\BookCollection;
use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientDetailsResource',
    description: 'ClientDetailsResource'
)]
class ClientDetailsResource extends JsonResource
{
    #[OA\Property(property: 'firstName', type: 'string')]
    #[OA\Property(property: 'lastName', type: 'string')]
    #[OA\Property(property: 'currentRentals', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Client $client */
        $client = $this->resource;

        return [
            'id' => $client->getKey(),
            'first_name' => $client->first_name,
            'last_name' => $client->last_name,
            'current_rentals' => $client->relationLoaded('currentRentals.books')
                ? BookCollection::make($client->currentRentals->pluck('books'))
                : [],
            'created_at' => $client->created_at->toDateTimeString(),
            'updated_at' => $client->updated_at->toDateTimeString(),
        ];
    }
}
