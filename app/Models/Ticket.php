<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
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
        return $this->belongsTo(User::class);
    }
    public function assignedTo() // El ticket es asignado a un usuario
    {
        return $this->belongsTo(User::class); //belongsTo
    }

}
