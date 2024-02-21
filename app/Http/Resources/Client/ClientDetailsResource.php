<?php

namespace App\Http\Resources\Client;

use App\Http\Resources\Book\RentedBooksCollection;
use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientDetailsResource',
    description: 'ClientDetailsResource'
)]
class ClientDetailsResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'first_name', type: 'string')]
    #[OA\Property(property: 'last_name', type: 'string')]
    #[OA\Property(property: 'rented_books', type: 'object')]
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
            'rented_books' => RentedBooksCollection::make($client->currentRentals->pluck('book')),
            'created_at' => $client->created_at->toDateTimeString(),
            'updated_at' => $client->updated_at->toDateTimeString(),
        ];
    }
}
