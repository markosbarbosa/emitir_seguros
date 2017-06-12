<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insured extends Model
{
    protected $fillable = [
        'document',
        'document_type',
        'full_name',
        'birth_date',
        'purchases_id'
    ];
}
