<?php

namespace App\Rules;

use App\Models\Rental;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class RentalAvailableToReturnRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (! $value instanceof Rental) {
            return;
        }

        if($value->returned_at !== null) {
            $fail('The this rental was already returned.');
        }
    }
}
