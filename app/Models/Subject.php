<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\Video;
use App\Models\Document;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $filliable = ['name', 'image'];

    public function quizzes() {
        return $this->hasMany(Quiz::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
