<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'text',
    ];

    public function media()
    {
        //todo:must be refactored. many to many rel.

        return $this->hasMany(Media_Post::class);
    }
}
