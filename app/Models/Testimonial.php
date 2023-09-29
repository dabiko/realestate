<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static findOrFail(string $decrypted_id)
 */
class Testimonial extends Model
{
    use HasFactory;

    protected $guarded = [];
}
