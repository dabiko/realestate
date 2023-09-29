<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static insertGetId(array $array)
 * @method static findOrFail(string $decrypted_id)
 * @method static where(string $string, $id)
 * @method  where(string $string, string $string, $id)
 * @method static count()
 *
 */
class Property extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
         return $this->belongsTo (Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo (User::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo (User::class, 'agent_id');
    }

    public function amenity(): BelongsTo
    {
        return $this->belongsTo (Amenity::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo (State::class);
    }



}
