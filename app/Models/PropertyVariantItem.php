<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 * @method static create(array $array)
 * @method static findOrFail(string $decrypted_id)
 */
class PropertyVariantItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(PropertyVariant::class);
    }
}
