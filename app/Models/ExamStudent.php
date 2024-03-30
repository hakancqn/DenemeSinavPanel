<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ExamStudent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'student_id');
    }

    public function exam(): HasOne
    {
        return $this->hasOne(Exam::class, 'id', 'exam_id');
    }
}
