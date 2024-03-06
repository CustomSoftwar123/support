<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tickettimeline extends Model
{
    use HasFactory;

    protected $fillable=[
        'ticketid',
        'text',
        'useremail',
        'assignedto',
        'openedby',
        'completedby',
        'status',
        'time',
    ];
}
