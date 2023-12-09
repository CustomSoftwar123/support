<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCMRequest extends Model
{
    use HasFactory;

    protected $table = 'OCMRequest';
    public $timestamps = false;
}
