<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(\Closure $param)
 */
class ChatMessage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo (User::class);
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo (User::class, 'agent_id');
    }

}
