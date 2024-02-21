<?php

namespace App\Rules;

use App\Models\Book;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BookAvailableToRentRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var Book $book */
        $book = Book::query()->find($value);

        if (! $book instanceof Book) {
            return;
        }

        if($book->currentRental !== null) {
            $fail('The book is not available to rent.');
        }
    }
}
