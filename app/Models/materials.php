<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materials extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'title',
        'type',
        'file_path',    
        'content',
        'is_published',
    ];
}
