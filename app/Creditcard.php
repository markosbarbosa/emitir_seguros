<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditcard extends Model
{

    protected $fillable = [
        'expiration_year',
        'expiration_month',
        'cvv',
        'brand',
        'number',
        'purchases_id'
    ];


    public function purchase() {
    	return $this->belongsTo('App\Purchase');
    }


}
