<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'class_id',
        'nis',
        'phone_number',
        // tambahkan atribut lain sesuai kebutuhan
    ];

    public function classRoom() // Saya pakai nama classRoom karena 'class' adalah keyword PHP
{
    return $this->belongsTo(Classes::class, 'class_id');
}
}
