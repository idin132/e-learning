<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id',
        'academic_years_id',
        'thumbnail',
        'description',
    ];

    public function subject()
    {
        return $this->belongsTo(subjects::class);
    }

    public function teachers()
    {
        return $this->belongsTo(teachers::class, 'teacher_id');
    }

    public function classRoom()
    {
        // pastikan nama model Classes benar (classes atau Classes)
        return $this->belongsTo(classes::class, 'class_id');
    }

    public function chapters()
    {
        // Parameter kedua adalah nama kolom foreign key di tabel chapters
        return $this->hasMany(chapters::class, 'course_id');
    }
}
