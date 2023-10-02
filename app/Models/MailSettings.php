<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $int)
 * @method static updateOrCreate(int[] $array, array $array1)
 * @method static first()
 */
class MailSettings extends Model
{
    use HasFactory;

    protected $guarded = [];
}
