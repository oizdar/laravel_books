<?php

namespace App\Http\Requests\Rental;

use App\Rules\RentalAvailableToReturnRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'RentalStoreRequest',
    description: 'RentalStoreRequest',
)]
class RentalReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rental' => [
                'required',
                new RentalAvailableToReturnRule(),
            ],

        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'rental' => $this->route('rental'),
        ]);
    }
}
