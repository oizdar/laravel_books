<?php

namespace App\Http\Requests\Rental;

use App\Rules\BookAvailableToRentRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'RentalStoreRequest',
    description: 'RentalStoreRequest',
)]
class RentalStoreRequest extends FormRequest
{
    #[OA\Property(property: 'book_id', type: 'integer')]
    #[OA\Property(property: 'client_id', type: 'integer')]
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => [
                'required',
                'integer',
                'exists:books,id',
                new BookAvailableToRentRule(),
            ],
            'client_id' => [
                'required',
                'integer',
                'exists:clients,id',
            ],
        ];
    }
}
