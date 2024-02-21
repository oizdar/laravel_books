<?php

namespace App\Http\Resources\Rental;

use App\Http\Resources\Book\RentedBookResource;
use App\Http\Resources\Client\ClientResource;
use App\Models\Rental;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientResource',
    description: 'ClientResource'
)]
class RentalResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'client', ref: '#/components/schemas/ClientResource', type: 'object')]
    #[OA\Property(property: 'book', ref: '#/components/schemas/RentedBookResource', type: ' object')]
    public function toArray($request): array
    {
        /** @var Rental $rental */
        $rental = $this->resource;

        return [
            'id' => $rental->getKey(),
            'client' => $rental->relationLoaded('client') ? ClientResource::make($rental->client) : null,
            'book' => $rental->relationLoaded('book') ? RentedBookResource::make($rental->book) : null,
            'returned_at' => $rental->returned_at,
            'rented_at' => $rental->created_at,
        ];
    }
}
