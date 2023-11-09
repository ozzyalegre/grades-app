<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;


    public function subject(){
        return $this->hasMany(Subject::class);
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
