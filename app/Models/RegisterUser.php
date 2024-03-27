<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tickets',
        'accepted_terms',
        'attended',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
