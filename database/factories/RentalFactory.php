<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => fn() => Client::factory()->create()->getKey(),
            'book_id' => fn() => Book::factory()->create()->getKey(),
            'returned_at' => null,
        ];
    }

    public function returned(Carbon $when): RentalFactory
    {
        return $this->state(fn() => [
            'returned_at' => $when ?? now(),
        ]);
    }

    public function forClient(Client $client): RentalFactory
    {
        return $this->state(fn() => [
            'client_id' => $client->getKey(),
        ]);
    }

    public function forBook(Book $book): RentalFactory
    {
        return $this->state(fn() => [
            'book_id' => $book->getKey(),
        ]);
    }


}
