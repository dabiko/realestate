<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail($decrypted_id)
 */
class Facility extends Model
{
    use HasFactory;

    protected $guarded = [];
}
