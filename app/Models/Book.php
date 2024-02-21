<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Data properties
 *-------------------
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $publisher
 * @property int $publication_year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Relationships
 * -------------------
 * @property Rental|null $currentRental
 * @property Collection<Rental> $rentals
 *
 * Methods
 * -------------------
 * @method static BookFactory factory($count = null, $state = [])
 */
class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_year',
    ];

    protected $casts = [
        'publication_year' => 'integer',
    ];

    protected array $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function currentRental(): HasOne
    {
        return $this->hasOne(Rental::class)
            ->whereNull('returned_at');
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function isRented(): bool
    {
        return $this->currentRental !== null;
    }
}
