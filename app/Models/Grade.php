<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ["letter", "gpa"];


    public function report(){
        return $this->belongsTo(Report::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }

    public function term(){
        return $this->belongsTo(Term::class);
    }
}
