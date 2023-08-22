<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atom extends Model
{
    use HasFactory;
    protected $fillable = ['word'];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'atom_article')->withPivot('occurrences');
    }
}
