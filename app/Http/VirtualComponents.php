<?php

namespace App\Http;

use OpenApi\Attributes as OA;

#[OA\Parameter(
    parameter: "page",
    name: 'page',
    description: "Current page",
    in: 'query',
    required: false,
    schema: new OA\Schema(
        type: 'integer',
    ),
)]
#[OA\Parameter(
    parameter: "per_page",
    name: 'per_page',
    description: "Elements per page",
    in: 'query',
    required: false,
    schema: new OA\Schema(
        type: 'integer',
    ),
)]
class VirtualComponents
{
}
