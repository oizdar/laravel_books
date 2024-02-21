<?php

namespace App\Http\Controllers;

use App\DTO\Client\ClientData;
use App\Http\Requests\Client\ClientIndexRequest;
use App\Http\Requests\Client\ClientStoreRequest;
use App\Http\Resources\Client\ClientCollection;
use App\Http\Resources\Client\ClientDetailsResource;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    #[OA\Get(
        path: '/clients',
        description: 'Get a list of Clients',
        tags: ['Clients'],
        parameters: [
            new OA\Parameter(ref: '#/components/parameters/page'),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ClientCollection',
                ),
            ),
        ],
    )]
    /**
     * Display a listing of the resource.
     */
    public function index(ClientIndexRequest $request): ClientCollection
    {
        $clients = Client::query()
            ->paginate(page: $request->validated('page', 1));

        return ClientCollection::make($clients);
    }

    #[OA\Get(
        path: '/clients/{client}',
        description: 'Get Client details',
        tags: ['Clients'],
        parameters: [
            new OA\Parameter(
                name: 'client',
                description: 'Client ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ClientResource',
                ),
            ),
        ],
    )]
    public function show(Client $client): ClientDetailsResource
    {
        return ClientDetailsResource::make($client);
    }

    #[OA\Post(
        path: '/clients',
        description: 'Create Client',
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                ref: '#/components/schemas/ClientStoreRequest'
            )
        ),
        tags: ['Clients'],
        responses: [
            new OA\Response(
                response: Response::HTTP_CREATED,
                description: 'CREATED',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ClientDetailsResource',
                ),
            ),
        ],
    )]
    public function store(ClientStoreRequest $request, ClientService $clientService): ClientResource
    {
        $client = $clientService->store(ClientData::from($request->validated()));

        return ClientResource::make($client);
    }


    #[OA\Delete(
        path: '/clients/{client}',
        description: 'Create Client',
        tags: ['Clients'],
        parameters: [
            new OA\Parameter(
                name: 'client',
                description: 'Client ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_NO_CONTENT,
                description: 'NO_CONTENT',
            ),
        ],
    )]
    public function destroy(Client $client, ClientService $clientService)
    {
        $clientService->destroy($client);

        return new Response(status: Response::HTTP_NO_CONTENT);
    }
}
