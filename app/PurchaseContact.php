<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseContact extends Model
{

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'purchases_id'
    ];

    public function purchase() {
        return $this->belongsTo('App\Purchase');
    }

}
