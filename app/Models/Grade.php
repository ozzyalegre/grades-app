<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ["letter", "gpa"];

    protected $casts = [
        'updated_at' => 'date:m-d',
    ];

    public static function getLatestGrade($term_id, $subject_id){
        $latest_grade = Grade::latest()->where([['term_id', $term_id], ['subject_id', $subject_id]])->first();

        return $latest_grade;
    }

    public static function findPastGrades($term_id, $subject_id, $column){
        $past_grades = Grade::latest()->where([['term_id', $term_id], ['subject_id', $subject_id]])->pluck($column)->take(10);
        return $past_grades;
        
    }

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
