<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $fillable=[
        'patientname',
        
        'patientname',
        'requestid',
        'sampleid',
        'subject',
        'department',
        'priority',
        'message',
        'ticketid',
        'agenda',
        'agenda_dev',
        'agenda_done',

    ];
}
