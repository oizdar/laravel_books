<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\Client\ClientResource;
use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'BookDetailsResource',
    description: 'BookDetailsResource'
)]
class BookDetailsResource extends JsonResource
{
    #[OA\Property(property: 'title', type: 'string')]
    #[OA\Property(property: 'author', type: 'string')]
    #[OA\Property(property: 'publisher', type: 'string')]
    #[OA\Property(property: 'publication_year', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Book $book */
        $book = $this->resource;

        return [
            'title' => $book->title,
            'author' => $book->author,
            'publisher' => $book->publisher,
            'publication_year' => $book->publication_year,
            'is_rented' => $book->relationLoaded('currentRental') ? $book->currentRental !== null : null,
            'rented_by' => $book->relationLoaded('currentRental') ? ClientResource::make($book->currentRental->client) : null,
            'created_at' => Carbon::parse($book->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($book->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
