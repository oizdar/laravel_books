<?php

namespace App\Http\Controllers;

use App\DTO\Rental\RentalData;
use App\Http\Requests\Rental\RentalReturnRequest;
use App\Http\Requests\Rental\RentalStoreRequest;
use App\Http\Resources\Rental\RentalResource;
use App\Models\Rental;
use App\Services\RentalService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class RentalController extends Controller
{
    #[OA\Post(
        path: '/rentals',
        description: 'Create Client',
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                ref: '#/components/schemas/RentalStoreRequest'
            )
        ),
        tags: ['Rentals'],
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: 'CREATED',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/RentalResource'
                ),
            ),
        ],
    )]
    public function store(RentalStoreRequest $request, RentalService $rentalService): RentalResource
    {
        $rental = $rentalService->store(RentalData::from($request->validated()));
        $rental->load(['client', 'book']);

        return RentalResource::make($rental);
    }

    #[OA\Patch(
        path: '/rentals/{rental}/return',
        description: 'Create Client',
        tags: ['Rentals'],
        parameters: [
            new OA\Parameter(
                name: 'rental',
                description: 'Rental ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer'),
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/RentalResource'
                ),
            ),
        ],
    )]
    public function return(RentalReturnRequest $request, Rental $rental, RentalService $rentalService): RentalResource
    {
        $rental = $rentalService->return($rental);
        $rental->load(['client', 'book']);

        return RentalResource::make($rental);
    }
}
