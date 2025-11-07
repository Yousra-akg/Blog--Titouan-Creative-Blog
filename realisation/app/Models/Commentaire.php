<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenu',
        'article_id',
        'user_id',
    ];

    /**
     * Relation avec User (auteur du commentaire)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec Article
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}