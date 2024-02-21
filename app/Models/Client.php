<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * Data properties
 *-------------------
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 *
 * Relationships
 * -------------------
 *
 * Methods
 * -------------------
 * @method static ClientFactory factory($count = null, $state = [])
 */
class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
    ];
}
