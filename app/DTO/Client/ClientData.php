<?php

namespace App\DTO\Client;

use Spatie\LaravelData\Data;

class ClientData extends Data
{
    public ?string $first_name;
    public ?string $last_name;
}
