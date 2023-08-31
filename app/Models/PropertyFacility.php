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
class PropertyFacility extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(Facility::class);
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

}
