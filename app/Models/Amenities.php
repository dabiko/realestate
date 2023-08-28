<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(string $decrypted_id)
 * @method static where(string $string, int $int)
 */
class Amenities extends Model
{
    use HasFactory;

    protected $guarded = [];

}
