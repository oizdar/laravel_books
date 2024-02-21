<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'ClientStoreRequest',
    description: 'ClientStoreRequest',
)]
class ClientStoreRequest extends FormRequest
{
    #[OA\Property(property: 'first_name', type: 'string')]
    #[OA\Property(property: 'last_name', type: 'string')]
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
        ];
    }
}
