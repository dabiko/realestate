<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static findOrFail(string $decrypted_id)
 */
class BlogPost extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo (BlogCategory::class, 'blog_category_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo (User::class);
    }
}
