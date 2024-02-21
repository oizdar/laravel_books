<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientCollection',
    description: 'ClientCollection',
)]
class ClientCollection extends ResourceCollection
{
    #[OA\Property(
        property: 'data',
        type: 'array',
        items: new OA\Items(
            ref: "#/components/schemas/ClientResource",
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
    public $collects = ClientResource::class;
}
