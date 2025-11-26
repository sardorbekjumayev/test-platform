<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\TestInstance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestInstanceQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_instance_id',
        'quiz_id',
        'user_answer',
        'is_correct',
    ];

    /*
     |-------------------------------------------------
     | RELATIONSHIPS
     |-------------------------------------------------
     */

    // Qaysi testga tegishli
    public function testInstance()
    {
        return $this->belongsTo(TestInstance::class);
    }

    // Asl savol modeli
    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }
}
