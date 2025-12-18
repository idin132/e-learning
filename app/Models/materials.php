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

    // --- TAMBAHKAN INI AGAR CONTROLLER TIDAK ERROR ---
    public function chapter()
    {
        return $this->belongsTo(chapters::class, 'chapter_id', 'id');
    }
}
