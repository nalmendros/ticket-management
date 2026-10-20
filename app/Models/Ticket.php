<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ticket extends Model
{
    const STATUSES = [
        'Pending',
        'In Process',
        'Resolved'
    ];

    const PRIORITIES = [
        'Low',
        'Medium',
        'High'
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

    // SCOPES

    public function scopeByStatuses($query, $status)
    {
        if ($status)
            return $query->whereIn('status', (array) $status);
    }

    public function scopeByPriorities($query, $priority)
    {
        if ($priority)
            return $query->whereIn('priority', (array) $priority);
    }

    public function scopeByUsers($query, $user)
    {
        return $query->when($user, function ($query, $user) {
            return $user === 'null'
            ? $query->whereNull('assigned_to')
            : $query->where('assigned_to', $user);
        });
    }

}
