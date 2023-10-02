<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, int $int)
 * @method static findOrFail(string $decrypted_id)
 */
class BlogPostComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo (User::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo (BlogPost::class, 'blog_posts_id');
    }
}
