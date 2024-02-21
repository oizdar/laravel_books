<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientIndexRequest;
use App\Http\Resources\Client\ClientCollection;
use App\Models\Client;
use Illuminate\Http\Request;
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
                    ref: '#/components/schemas/BookCollection',
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

        return new ClientCollection($clients);
    }

//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Client $client)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request, Client $client)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(Client $client)
//    {
//        //
//    }
}
