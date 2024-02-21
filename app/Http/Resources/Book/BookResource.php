<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Client\ClientResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'BookResource',
    description: 'BookResource'
)]
class BookResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'title', type: 'string')]
    #[OA\Property(property: 'is_rented', type: 'boolean')]
    #[OA\Property(property: 'rented_by', ref: '#/components/schemas/ClientResource', type: 'object', nullable: true)]
    public function toArray($request): array
    {
        /** @var Book $book */
        $book = $this->resource;

        return [
            'id' => $book->getKey(),
            'title' => $book->title,
            'is_rented' => $book->relationLoaded('currentRental')
                ? $book->isRented()
                : null,
            'rented_by' => $book->relationLoaded('currentRental') && $book->currentRental?->relationLoaded('client')
                ? ClientResource::make($book->currentRental->client)
                : null,
        ];
    }
}
