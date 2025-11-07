<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'slug',
    ];

    /**
     * Relation many-to-many avec Articles
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}