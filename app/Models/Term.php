<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class Term extends Model
{
    use HasFactory;
    protected $fillable = ["name"];

    public static function findCurrentTerm(){
        $terms = Term::all();
        foreach ($terms as $key => $t) {
            $grades_count = Grade::where('term_id', $t->id)->count();
            if ($key == 0 && $grades_count == 0) {
                $terms[$key];
            }
            elseif (($key != 0 && $grades_count == 0) ) {
                return $terms[$key-1];
            }
        }
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }
}
