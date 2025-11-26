<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'subject_id',
        'quiz',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
    ];

    public function subject () {
        return $this->belongsTo(Subject::class);
    }
}
