<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atom extends Model
{
    use HasFactory;
    protected $fillable = ['word'];

    /**
     * Получение статей, содержащих слово
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'atom_article')->withPivot('occurrences');
    }
}
