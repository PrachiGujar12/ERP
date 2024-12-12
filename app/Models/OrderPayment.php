<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payment';

    // Define fillable fields
    protected $fillable = [
        'order_id',
        'payment_type',
        'invoice_type',
        'customer_id',
        'amount',
        'ref_no',
    ];
}
