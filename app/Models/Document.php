<?php

namespace App\Models;

use Storage;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'subject_id',
        'title',
        'type',
        'file_path',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
