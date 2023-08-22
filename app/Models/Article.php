<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function atoms()
    {
        return $this->belongsToMany(Atom::class)->withPivot('occurrences');
    }
}
