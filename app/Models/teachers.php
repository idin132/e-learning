<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class teachers extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nip',
        'phone_number',
    ];

    public function user() // Huruf kecil 'u'
    {
        return $this->belongsTo(User::class);
    }
}
