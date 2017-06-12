<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    protected $fillable = [
        'product_code',
        'destination',
        'coverage_begin',
        'coverage_end',
        'payment_method',
        'price',
        'parcels',
        'holder_name',
        'holder_cpf'
    ];


    public function insureds() {
    	return $this->hasMany('App\Insured');
    }

    public function creditcard() {
    	return $this->hasOne('App\Creditcard');
    }

    public function purchaseContct() {
    	return $this->hasOne('App\PurchaseContact');
    }

}
