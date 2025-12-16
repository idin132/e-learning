<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chapters extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
    ];

    public function materials()
    {
        return $this->hasMany(materials::class, 'chapter_id', 'id');
    }

    public function course()
    {
        // Parameter kedua adalah foreign key di tabel chapters sendiri
        // Parameter ketiga adalah owner key di tabel courses (id)
        return $this->belongsTo(courses::class, 'course_id', 'id');
    }
}
