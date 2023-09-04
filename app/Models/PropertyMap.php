<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $decrypted_id)
 * @method static updateOrCreate(int[] $array, array $array1)
 */
class PropertyMap extends Model
{
    use HasFactory;

    protected $guarded = [];
}
