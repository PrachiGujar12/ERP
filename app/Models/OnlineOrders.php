<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineOrders extends Model
{
    use HasFactory;
    public $table = 'online_orders';
    public $primaryKey = 'online_order_id';

    public function customer()
    {
        return $this->belongsTo(OnlineCustomers::class, 'customer_id', 'online_customer_id');
    }
    

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
