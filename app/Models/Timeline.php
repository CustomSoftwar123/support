<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    protected $table = 'timeline';
    protected $fillable=[
        'ticketid',
        'time1',
        'time2',
        'totaltime'

    ];
    public function getTimeline($ticketid){
        return $ticketTime =Timeline::query()->where("ticketid", $ticketid)->latest();

    }
}
