<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $table = 'questions';
    protected $fillable = [
        'quiz_id',
        'title',
        'status',
    ];
}
