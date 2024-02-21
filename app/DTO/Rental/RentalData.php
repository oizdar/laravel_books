<?php

namespace App\DTO\Rental;

use Spatie\LaravelData\Data;

class RentalData extends Data
{
    public ?string $client_id;
    public ?string $book_id;

}
