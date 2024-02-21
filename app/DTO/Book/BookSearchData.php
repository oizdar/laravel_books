<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\BookIndexRequest;
use Spatie\LaravelData\Data;

class BookSearchData extends Data
{
    public ?string $title;
    public ?string $author;
    public ?string $clientFirstName;
    public ?string $clientLastName;

    public static function fromBookIndexRequest(BookIndexRequest $request): self
    {
        return static::from([
            'title' => $request->validated('title'),
            'author' => $request->validated('author'),
            'clientFirstName' => $request->validated('client_first_name'),
            'clientLastName' => $request->validated('client_last_name'),
        ]);
    }
}
