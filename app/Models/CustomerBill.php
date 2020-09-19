<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerBill extends Model
{
    protected $table ='customer_bill';
    protected $fillable = ['customer_id', 'bill_month','amount','year','status'];


    public function getUserData()
    {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }
}
