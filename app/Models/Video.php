<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'subject_id',
        'title',
        'url',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
