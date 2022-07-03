<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media_Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id', 'post_id',
    ];

    protected $table = 'media_post';

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
