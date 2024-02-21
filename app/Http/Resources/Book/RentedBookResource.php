<?php

namespace App\Http\Resources\Book;

use App\Models\Book;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'RentedBookResource',
    description: 'RentedBookResource'
)]
class RentedBookResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'title', type: 'string')]
    public function toArray($request): array
    {
        /** @var Book $book */
        $book = $this->resource;

        return [
            'id' => $book->getKey(),
            'title' => $book->title,
        ];
    }
}
