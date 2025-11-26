<?php
namespace App\Models;

use App\Models\User;
use App\Models\Subject;
use App\Models\TestInstanceQuestion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestInstance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'district',
        'expires_at',
        'score',
    ];

    protected $dates = ['expires_at'];
    
    protected $casts = [
    'started_at' => 'datetime',
    'expires_at' => 'datetime',
];

    /*
     |-------------------------------------------------
     | RELATIONSHIPS
     |-------------------------------------------------
     */

    // Testni boshlagan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Qaysi fan bo‘yicha test
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // Testga tegishli 20 ta savollar
    public function questions()
    {
        return $this->hasMany(TestInstanceQuestion::class);
    }
}
