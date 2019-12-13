<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    const STATUS = ['open', 'reopen', 'inprogress', 'closed'];

    protected $table = 'tickets';

    protected $fillable = [
        'customer_id',
        'agent_id',
        'title',
        'description',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
