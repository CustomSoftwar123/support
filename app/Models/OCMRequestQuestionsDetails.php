<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCMRequestQuestionsDetails extends Model
{
    use HasFactory;

    protected $table = 'OCMRequestQuestionsDetails';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
