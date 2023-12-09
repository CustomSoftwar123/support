<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OCMRequestTestDetails extends Model
{
    use HasFactory;

    protected $table = 'ocmrequesttestsdetails';
    protected $primaryKey = 'sampleID';
    public $timestamps = false;
}
