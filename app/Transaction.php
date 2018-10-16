<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model {

    protected $fillable = [
        'id', 'amount', 'date', 'limit', 'customerId'
    ];

    public function customer() {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public static function getTransactionByFilters($customerId, $amount, $date, $offset, $limit) {
        return DB::table('transactions')
            ->where('customer_id', $customerId)
            ->where('amount', $amount)
            ->where('updated_at', '>=', $date)
            ->where('limit', $limit)
            ->take($offset)
            ->get();
    }
}