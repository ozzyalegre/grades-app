<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = ["message_id", "date_received", "from", "html_body"];

    public function grades(){
        return $this->hasMany(Grade::class);
    }

    public static function lastReportGrades(){
        return Report::latest()->first()->grades()
            ->with(['subject', 'term'])
            ->get();
    }
}
