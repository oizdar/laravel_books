<?php

namespace App\Models;

use Database\Factories\RentalFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Data properties
 *-------------------
 * @property int $id
 * @property int $client_id
 * @property int $book_id
 * @property Carbon|null $returned_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * Relationships
 * -------------------
 * @property Book $book
 * @property Client $client
 *
 * Methods
 * -------------------
 * @method static RentalFactory factory($count = null, $state = [])
 */
class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'book_id',
        'returned_at',
    ];

    protected array $dates = [
        'created_at',
        'updated_at',
        'returned_at',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
