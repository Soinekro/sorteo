<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SorteoPremio extends Model
{
    use HasFactory;

    protected $table = 'sorteo_premios';
    protected $fillable = [
        'premio_id',
        'ticket_id',
        'active'
    ];
    public function premio()
    {
        return $this->belongsTo(Premio::class);
    }

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
