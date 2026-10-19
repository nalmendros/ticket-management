<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    const STATUSES = [
        'pending',
        'in_process',
        'resolved'
    ];

    const PRIORITIES = [
        'low',
        'medium',
        'high'
    ];
    
    protected $fillable = [
        'created_by',
        'assigned_to',
        'title',
        'description',
        'status',
        'priority'
    ];
    
    public function createdBy() // El ticket es creado por una persona
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function assignedTo() // El ticket es asignado a un usuario
    {
        return $this->belongsTo(User::class, 'assigned_to'); //belongsTo
    }

}
