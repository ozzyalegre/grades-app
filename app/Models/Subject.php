<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ["name", "period"];
}
