<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the feed that owns the article.
     */
    public function feed(): BelongsTo
    {
        return $this->belongsTo(Feed::class);
    }
}
