<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';
    protected $fillable = [
        'user_id',
        'date',
        'name',
        'description',
        'status',
        'pin',
        'time',
        'second',
        'time'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
