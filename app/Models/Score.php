<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['ID','id_user','academicyear','course','subject','trimester', 'mark1', 'mark2','mark3'];
}
