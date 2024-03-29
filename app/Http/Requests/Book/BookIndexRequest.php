<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'BookIndexRequest',
    description: 'BookIndexRequest',
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
            'per_page' => [
                'nullable',
                'integer',
                'min:10',
                'max:500',
            ],
            'title' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],
            'author' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],
            'client_first_name' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],
            'client_last_name' => [
                'nullable',
                'string',
                'min:3',
                'max:255',
            ],

        ];
    }
}
