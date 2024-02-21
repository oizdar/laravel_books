<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'DispositionIndexRequest',
    description: 'DispositionIndexRequest',
)]
class BookIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => [
                'nullable',
                'integer',
                'min:1',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        //filters
    }
}
