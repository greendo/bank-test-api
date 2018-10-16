<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

    protected $fillable = [
        'id', 'name', 'cnp'
    ];

    public function posts() {
        return $this->hasMany('App\Transaction', 'customer_id');
    }
}