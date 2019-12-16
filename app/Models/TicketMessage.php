<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'tickets_message';

    protected $fillable = [
        'ticket_id',
        'message',
        'commentable_id',
        'commentable_type'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function commentable()
    {
        return $this->morphTo();
    }
}
