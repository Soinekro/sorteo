<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    //table
    protected $table = 'tickets';
    protected $fillable = [
        'user_id',
        'ticket',
        'active'
    ];
}
