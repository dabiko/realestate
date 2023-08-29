<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static findOrFail(string $decrypted_id)
 * @method static create(array $array)
 * @method where(string $string, string $decryptId)
 */
class PropertyGallery extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
