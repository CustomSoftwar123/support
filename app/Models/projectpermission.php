<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectpermission extends Model
{
    use HasFactory;
    protected $fillable=[
        'userid',
        'projectid',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class, 'projectid', 'id');
    }

}
