<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'source', 'user_id', 'type', 'mime_type',
    ];

    public function posts()
    {
        //todo:must be refactored. many to many rel.

        return $this->belongsToMany(Post::class);
    }
}
