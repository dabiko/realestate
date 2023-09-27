<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static create(array $array)
 * @method static count()
 */
class Compare extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(PropertyLocation::class, 'property_id');
    }

    public function detail(): BelongsTo
    {
        return $this->belongsTo(PropertyDetail::class, 'property_id');
    }

}
