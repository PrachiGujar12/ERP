<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairOrderReturnPayment extends Model
{
    use HasFactory;

    protected $table = 'repair_order_return_payment';

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