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
        'active',
    ];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function sorteado()
    {
        return $this->hasMany(SorteoPremio::class);
    }
}
