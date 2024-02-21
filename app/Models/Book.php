<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Data properties
 *-------------------
 * @property int $id
 * @property string $title
 * @property string $author
 * @property string $publisher
 * @property int $release_year
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * Relationships
 * -------------------
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
        'release_year',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
