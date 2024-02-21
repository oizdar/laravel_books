<?php

namespace App\Services;

use App\DTO\Rental\RentalData;
use App\Models\Rental;
use Throwable;

class RentalService
{
    public function store(RentalData $rentalStoreData): Rental
    {
        /** @var Rental $rental */
        $rental = Rental::query()
            ->create($rentalStoreData->toArray());

        return $rental;
    }

    /**
     * @throws Throwable
     */
    public function return(Rental $rental): Rental
    {
        $rental->update(['returned_at' => now()]);

        return $rental->fresh();
    }

}
