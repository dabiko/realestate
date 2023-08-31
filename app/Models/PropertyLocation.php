<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $property_id)
 * @method static create(array $array)
 * @method static findOrFail(string $decrypted_id)
 */
class PropertyLocation extends Model
{
    use HasFactory;

    protected $guarded = [];
}
