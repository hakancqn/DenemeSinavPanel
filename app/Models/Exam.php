<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->hasOne(User::class);
    }

    public function exam_request()
    {
        return $this->hasMany(ExamRequest::class);
    }
}
