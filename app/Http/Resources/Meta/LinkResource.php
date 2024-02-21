<?php

namespace App\Http\Resources\Meta;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "LinkResource",
    description: "LinkResource"
)]
class LinkResource extends JsonResource
{

    #[OA\Property(property: "first", description: "First page url", type: "string", format: "url")]
    #[OA\Property(property: "last", description: "Last page url", type: "string", format: "url")]
    #[OA\Property(property: "prev", description: "Previous page url", type: "string", format: "url", nullable: true)]
    #[OA\Property(property: "next", description: "Next page url", type: "string", format: "url", nullable: true)]
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
