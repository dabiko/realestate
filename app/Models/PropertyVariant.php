<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method where(string $string, $decryptId)
 * @method static findOrFail(string $decrypted_id)
 * @method static withCount(string $decrypted_id)
 */
class PropertyVariant extends Model
{
    use HasFactory;

    protected $guarded = [];
}
