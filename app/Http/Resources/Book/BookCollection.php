<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'BookCollection',
    description: 'BookCollection',
)]
class BookCollection extends ResourceCollection
{
    #[OA\Property(
        property: 'data',
        type: 'array',
        items: new OA\Items(
            ref: "#/components/schemas/BookResource",
        ),
    )]
    #[OA\Property(
        property: 'links',
        ref: "#/components/schemas/LinkResource",
        type: 'object',
    )]
    #[OA\Property(
        property: 'meta',
        ref: "#/components/schemas/MetaResource",
        type: 'object',
    )]
    public $collects = BookResource::class;
}
