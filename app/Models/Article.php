<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Article extends Model
{
    use HasFactory;

    /**
     * Получение слов-атомов, связанных со статьёй
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function atoms()
    {
        return $this->belongsToMany(Atom::class, 'atom_article')->withPivot('occurrences');
    }
}
