<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['id','users_id','academicYear','course','subject','quarter', 'mark1', 'mark2','mark3'];
}
