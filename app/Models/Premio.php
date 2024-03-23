<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
