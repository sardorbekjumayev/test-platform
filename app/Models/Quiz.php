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
        if (!empty($value)) {
            return $value;
        }

        // Agar bazada type ustuni bo'lmasa, answer dan aniqlaymiz
        return $this->isMultiple() ? 'multiple' : 'single';
    }

    /**
     * Savol bir nechta to'g'ri javoblimi (multiple choice)?
     */
    public function isMultiple(): bool
    {
        // 1. Agar type maydonida 'multiple' bo'lsa
        if (isset($this->attributes['type']) && $this->attributes['type'] === 'multiple') {
            return true;
        }

        // 2. Agar answer JSON array bo'lsa (baza strukturasi o'zgarmagan taqdirda ham)
        if (!empty($this->answer)) {
            $trimmed = trim($this->answer);
            if (str_starts_with($trimmed, '[') && str_ends_with($trimmed, ']')) {
                $decoded = json_decode($trimmed, true);
                if (is_array($decoded)) {
                    return true;
                }
            }
        }

        return false;
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
