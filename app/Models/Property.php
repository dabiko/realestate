<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
         return $this->belongsTo (PropertyCategory::class);
    }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo (User::class);
    }
}
