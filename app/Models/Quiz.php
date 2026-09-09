<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'subject_id',
        'type',
        'quiz',
        'option1',
        'option2',
        'option3',
        'option4',
        'answer',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Savol turini olish (default: 'single')
     */
    public function getTypeAttribute($value): string
    {
        return $value ?? 'single';
    }

    /**
     * Savol ko'p javoblimi (multiple choice)?
     */
    public function isMultiple(): bool
    {
        return ($this->type ?? 'single') === 'multiple';
    }

    /**
     * To'g'ri javoblarni massiv ko'rinishida olish
     */
    public function getCorrectAnswersAttribute(): array
    {
        if ($this->isMultiple()) {
            $decoded = json_decode($this->answer, true);
            if (is_array($decoded)) {
                return $decoded;
            }
            if (!empty($this->answer)) {
                return array_map('trim', explode(',', $this->answer));
            }
            return [];
        }

        return !empty($this->answer) ? [$this->answer] : [];
    }

    /**
     * To'g'ri javoblar indeksi (0, 1, 2, 3) massivini olish (admin edit uchun)
     */
    public function getCorrectIndexesAttribute(): array
    {
        $allOptions = [$this->option1, $this->option2, $this->option3, $this->option4];
        $correct = $this->correct_answers;

        $indexes = [];
        foreach ($allOptions as $idx => $opt) {
            if ($opt !== null && in_array($opt, $correct)) {
                $indexes[] = $idx;
            }
        }
        return $indexes;
    }
}
