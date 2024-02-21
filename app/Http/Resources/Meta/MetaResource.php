<?php

namespace App\Http\Resources\Meta;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: "MetaResource",
    description: "MetaResource"
)]
class MetaResource extends JsonResource
{
    #[OA\Property(property: "current_page", description: "Current page", type: "integer")]
    #[OA\Property(property: "from", description: "From element", type: "integer", nullable: true)]
    #[OA\Property(property: "last_page", description: "Last page", type: "integer")]
    #[OA\Property(property: "path", description: "Url path", type: "string", format: "url")]
    #[OA\Property(property: "per_page", description: "Items per page", type: "integer")]
    #[OA\Property(property: "to", description: "To element", type: "integer", nullable: true)]
    #[OA\Property(property: "total", description: "Total items", type: "integer")]
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
